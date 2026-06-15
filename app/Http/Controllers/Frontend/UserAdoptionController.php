<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdoptionApplication;
use App\Models\InterviewSlot;
use App\Services\MailService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAdoptionController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->hasAnyRole(['admin', 'staff'])) {
            return redirect()->route('home')->with('error', 'Tài khoản quản trị không sử dụng chức năng này.');
        }

        $query = AdoptionApplication::with(['thuCung', 'interviewSlot'])
            ->where('Ma_nguoi_dung', Auth::id());

        // Overview Statistics
        $totalPets = (clone $query)->count();
        $adoptedPets = (clone $query)->where('Trang_thai', 'hoan_thanh')->count();
        $pendingPets = (clone $query)->whereIn('Trang_thai', ['cho_duyet', 'cho_xac_nhan_don', 'cho_phong_van'])->count();

        // Xử lý Tìm kiếm
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('Ma_don', 'like', "%{$search}%")
                  ->orWhereHas('thuCung', function($q) use ($search) {
                      $q->where('Ten', 'like', "%{$search}%");
                  });
            });
        }

        // Xử lý Bộ lọc trạng thái
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('Trang_thai', $request->status);
        }

        // Xử lý Lọc theo thời gian (giả định 1 số mốc cơ bản)
        if ($request->filled('time') && $request->time !== 'all') {
            switch ($request->time) {
                case 'this_month':
                    $query->whereMonth('Ngay_tao', now()->month)->whereYear('Ngay_tao', now()->year);
                    break;
                case 'last_3_months':
                    $query->where('Ngay_tao', '>=', now()->subMonths(3));
                    break;
                case 'this_year':
                    $query->whereYear('Ngay_tao', now()->year);
                    break;
            }
        }

        // Xử lý Sắp xếp
        $sort = $request->get('sort', 'newest');
        if ($sort === 'newest') {
            $query->orderByDesc('Ngay_tao');
        } elseif ($sort === 'oldest') {
            $query->orderBy('Ngay_tao');
        } else {
            $query->orderByDesc('Ngay_tao'); // Default
        }

        // Số lượng item trên trang
        $perPage = $request->get('per_page', 10);
        $applications = $query->paginate($perPage)->withQueryString();

        // Lấy danh sách các slot trống (ở tương lai, và còn sức chứa)
        $availableSlots = InterviewSlot::where('Trang_thai', 'mo')
            ->whereDate('Ngay', '>=', now()->toDateString())
            ->whereRaw('So_luong_hien_tai < So_luong_toi_da')
            ->orderBy('Ngay')
            ->orderBy('Gio_bat_dau')
            ->get();

        return view('frontend.users.adoptions.index', compact(
            'applications', 'availableSlots', 'totalPets', 'adoptedPets', 'pendingPets'
        ));
    }

    public function scheduleInterview(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->hasAnyRole(['admin', 'staff'])) {
            return redirect()->route('home')->with('error', 'Tài khoản quản trị không sử dụng chức năng này.');
        }

        $application = AdoptionApplication::where('Ma_nguoi_dung', Auth::id())
            ->findOrFail($id);

        if ($application->Trang_thai !== 'cho_xac_nhan_don' || $application->interview_slot_id !== null) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Đơn của bạn không trong trạng thái chờ xếp lịch.'], 400);
            }
            return back()->with('error', 'Đơn của bạn không trong trạng thái chờ xếp lịch.');
        }

        if ($application->han_xac_nhan_phong_van && now()->greaterThan($application->han_xac_nhan_phong_van)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Đã quá hạn xác nhận lịch phỏng vấn.'], 400);
            }
            return back()->with('error', 'Đã quá hạn xác nhận lịch phỏng vấn.');
        }

        $validated = $request->validate([
            'interview_slot_id' => 'required|exists:interview_slots,Ma_slot',
        ]);

        try {
            DB::transaction(function () use ($application, $validated) {
                $slot = InterviewSlot::lockForUpdate()->findOrFail($validated['interview_slot_id']);
                
                if ($slot->So_luong_hien_tai >= $slot->So_luong_toi_da) {
                    throw new \Exception('Ca phỏng vấn này đã đầy. Vui lòng chọn ca khác.');
                }

                // Tăng số lượng
                $slot->increment('So_luong_hien_tai');
                
                if ($slot->So_luong_hien_tai >= $slot->So_luong_toi_da) {
                    $slot->update(['Trang_thai' => 'day']);
                }

                // Gắn vào đơn
                $application->update([
                    'interview_slot_id' => $slot->Ma_slot,
                    'han_xac_nhan_phong_van' => null, // Đã xác nhận xong
                    'Trang_thai' => 'cho_phong_van', // MỚI: Chuyển đơn sang chờ phỏng vấn
                ]);

                // MỚI: Tạo lịch phỏng vấn chính thức để Admin quản lý
                \App\Models\InterviewSchedule::updateOrCreate(
                    ['Ma_don' => $application->Ma_don],
                    [
                        'Ma_slot' => $slot->Ma_slot,
                        'Ket_qua_phong_van' => null,
                        'Trang_thai' => 'da_xac_nhan',
                        'Ghi_chu' => 'Người dùng tự đăng ký lịch'
                    ]
                );
                
                // Load lại slot để gửi email
                $application->load(['interviewSlot', 'thuCung']);
            });

            // Gửi email xác nhận
            $mailService = app(MailService::class);
            $user = Auth::user();
            $slot = $application->interviewSlot;
            
            $subject = 'Xác nhận lịch phỏng vấn nhận nuôi thú cưng';
            $body = view('emails.partials.interview_scheduled', [
                'user' => $user,
                'application' => $application,
                'slot' => $slot
            ])->render();

            $mailService->send($user->email, $subject, $body);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Xác nhận lịch phỏng vấn thành công! Chúng tôi đã gửi email thông tin chi tiết cho bạn.']);
            }
            return back()->with('success', 'Xác nhận lịch phỏng vấn thành công! Chúng tôi đã gửi email thông tin chi tiết cho bạn.');

        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
            }
            return back()->with('error', $e->getMessage());
        }
    }
}
