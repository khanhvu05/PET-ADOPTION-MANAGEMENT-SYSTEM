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
    public function index()
    {
        $applications = AdoptionApplication::with(['thuCung', 'interviewSlot'])
            ->where('Ma_nguoi_dung', Auth::id())
            ->orderByDesc('Ngay_tao')
            ->paginate(10);

        // Lấy danh sách các slot trống (ở tương lai, và còn sức chứa)
        $availableSlots = InterviewSlot::where('Trang_thai', 'mo')
            ->whereDate('Ngay', '>=', now()->toDateString())
            ->whereRaw('So_luong_hien_tai < So_luong_toi_da')
            ->orderBy('Ngay')
            ->orderBy('Gio_bat_dau')
            ->get();

        return view('frontend.users.adoptions.index', compact('applications', 'availableSlots'));
    }

    public function scheduleInterview(Request $request, $id)
    {
        $application = AdoptionApplication::where('Ma_nguoi_dung', Auth::id())
            ->findOrFail($id);

        if ($application->Trang_thai !== 'approved' || $application->interview_slot_id !== null) {
            return back()->with('error', 'Đơn của bạn không trong trạng thái chờ xếp lịch.');
        }

        if ($application->han_xac_nhan_phong_van && now()->greaterThan($application->han_xac_nhan_phong_van)) {
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

                // MỚI: Đổi trạng thái thú cưng sang chờ phỏng vấn
                if ($application->thuCung) {
                    $application->thuCung->update(['Trang_thai' => 'cho_phong_van']);
                }
                
                // Load lại slot để gửi email
                $application->load('interviewSlot');
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

            return back()->with('success', 'Xác nhận lịch phỏng vấn thành công! Chúng tôi đã gửi email thông tin chi tiết cho bạn.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
