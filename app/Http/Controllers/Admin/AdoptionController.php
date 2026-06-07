<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdoptionApplication;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\InterviewInvitationEmail;
use App\Mail\ApplicationRejectedEmail;
use App\Mail\InterviewReminderEmail;
use App\Mail\InterviewTimeoutEmail;
use App\Mail\InterviewPassedEmail;

class AdoptionController extends Controller
{
    /**
     * Danh sách đơn nhận nuôi với filter và thống kê thật
     */
    public function index(Request $request)
    {
        $query = AdoptionApplication::with(['thuCung', 'nguoiDung'])->orderByDesc('Ngay_tao');

        // Search theo tên người đăng ký, SĐT, hoặc mã đơn
        if ($request->filled('search')) {
            $search = $request->search;
            $cleanSearch = ltrim($search, '#');
            $query->where(function ($q) use ($search, $cleanSearch) {
                $q->where('Ho_ten', 'like', "%{$search}%")
                  ->orWhere('So_dien_thoai', 'like', "%{$search}%")
                  ->orWhere('Ma_don', 'like', "%{$cleanSearch}%");
            });
        }

        // Filter theo trạng thái
        if ($request->filled('trang_thai')) {
            $query->where('Trang_thai', $request->trang_thai);
        }

        // Filter theo loài thú cưng
        if ($request->filled('loai_thu_cung')) {
            $query->whereHas('thuCung', fn($q) => $q->where('Loai', $request->loai_thu_cung));
        }

        // Filter theo ngày tạo
        if ($request->filled('ngay_tu') && $request->filled('ngay_den')) {
            $query->whereBetween('Ngay_tao', [$request->ngay_tu . ' 00:00:00', $request->ngay_den . ' 23:59:59']);
        }

        $perPage = $request->input('per_page', 5);
        $applications = $query->paginate($perPage)->withQueryString();

        // Stats thật
        $currentMonth = \Carbon\Carbon::now()->month;
        $currentYear = \Carbon\Carbon::now()->year;
        $lastMonth = \Carbon\Carbon::now()->subMonth()->month;
        $lastMonthYear = \Carbon\Carbon::now()->subMonth()->year;

        $calcMetric = function($query) use ($currentMonth, $currentYear, $lastMonth, $lastMonthYear) {
            $totalCurrent = (clone $query)->count();
            $newThisMonth = (clone $query)->whereYear('Ngay_tao', $currentYear)->whereMonth('Ngay_tao', $currentMonth)->count();
            $newLastMonth = (clone $query)->whereYear('Ngay_tao', $lastMonthYear)->whereMonth('Ngay_tao', $lastMonth)->count();
            
            if ($newLastMonth > 0) {
                $pct = round((($newThisMonth - $newLastMonth) / $newLastMonth) * 100, 1);
            } else {
                $pct = $newThisMonth > 0 ? 100 : 0;
            }
            return [
                'count' => $totalCurrent,
                'percent' => $pct
            ];
        };

        $stats = [
            'total'        => $calcMetric(AdoptionApplication::query()),
            'pending'      => $calcMetric(AdoptionApplication::where('Trang_thai', 'cho_duyet')),
            'approved'     => $calcMetric(AdoptionApplication::whereIn('Trang_thai', ['cho_xac_nhan_don', 'cho_phong_van', 'da_duyet'])),
            'completed'    => $calcMetric(AdoptionApplication::where('Trang_thai', 'hoan_thanh')),
            'rejected'     => $calcMetric(AdoptionApplication::where('Trang_thai', 'tu_choi')),
        ];

        return view('admin.adoptions.index', compact('applications', 'stats'));
    }

    /**
     * Xuất danh sách đơn nhận nuôi ra Excel
     */
    public function export(Request $request)
    {
        $query = AdoptionApplication::with(['thuCung', 'nguoiDung'])->orderByDesc('Ngay_tao');

        // Search theo tên người đăng ký, SĐT, hoặc mã đơn
        if ($request->filled('search')) {
            $search = $request->search;
            $cleanSearch = ltrim($search, '#');
            $query->where(function ($q) use ($search, $cleanSearch) {
                $q->where('Ho_ten', 'like', "%{$search}%")
                  ->orWhere('So_dien_thoai', 'like', "%{$search}%")
                  ->orWhere('Ma_don', 'like', "%{$cleanSearch}%");
            });
        }

        // Filter theo trạng thái
        if ($request->filled('trang_thai')) {
            $query->where('Trang_thai', $request->trang_thai);
        }

        // Filter theo loài thú cưng
        if ($request->filled('loai_thu_cung')) {
            $query->whereHas('thuCung', fn($q) => $q->where('Loai', $request->loai_thu_cung));
        }

        // Filter theo ngày tạo
        if ($request->filled('ngay_tu') && $request->filled('ngay_den')) {
            $query->whereBetween('Ngay_tao', [$request->ngay_tu . ' 00:00:00', $request->ngay_den . ' 23:59:59']);
        }

        $applications = $query->get();

        $writer = \Spatie\SimpleExcel\SimpleExcelWriter::streamDownload('Danh_sach_don_nhan_nuoi.xlsx');

        foreach ($applications as $app) {
            $writer->addRow([
                'Mã đơn' => $app->Ma_don,
                'Người đăng ký' => $app->nguoiDung->Ho_ten ?? $app->Ho_ten,
                'Số điện thoại' => $app->nguoiDung->So_dien_thoai ?? $app->So_dien_thoai,
                'Thú cưng' => $app->thuCung->Ten ?? 'N/A',
                'Trạng thái' => $app->trang_thai_label,
                'Nghề nghiệp' => $app->Nghe_nghiep,
                'Kinh nghiệm' => $app->Kinh_nghiem,
                'Ngày tạo' => $app->Ngay_tao->format('d/m/Y H:i'),
            ]);
        }

        return $writer->toBrowser();
    }

    /**
     * Form tạo đơn mới (admin tự tạo - hiếm khi dùng)
     */
    public function create()
    {
        $pets = Pet::where('Trang_thai', 'san_sang')->orderBy('Ten')->get();
        $users = \App\Models\User::orderBy('Ho_ten')->get();
        return view('admin.adoptions.create', compact('pets', 'users'));
    }

    /**
     * Xử lý lưu đơn nhận nuôi mới từ Admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Ma_thu_cung'       => 'required|exists:pets,Ma_thu_cung',
            'user_mode'         => 'required|in:existing,new',
            'Ma_nguoi_dung'     => 'required_if:user_mode,existing|nullable|exists:users,Ma_nguoi_dung',
            'new_user_email'    => 'required_if:user_mode,new|nullable|email|unique:users,Email',
            'new_user_password' => 'required_if:user_mode,new|nullable|min:6',
            'Ho_ten'            => 'required|string|max:100',
            'So_dien_thoai'     => ['required', 'string'],
            'Dia_chi'           => 'required|string|max:500',
            'Nghe_nghiep'       => 'nullable|string|max:100',
            'Loai_nha_o'        => 'nullable|string|max:100',
            'Kinh_nghiem'       => 'nullable|string|max:1000',
            'Ly_do_nhan_nuoi'   => 'required|string|max:2000',
            'Ghi_chu_admin'     => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($validated) {
                // Kiểm tra pet còn sẵn sàng không
                $pet = Pet::where('Ma_thu_cung', $validated['Ma_thu_cung'])->lockForUpdate()->first();
                if (!$pet || $pet->Trang_thai !== 'san_sang') {
                    throw new \Exception('Thú cưng này không còn sẵn sàng nhận nuôi.');
                }

                // Xử lý người dùng
                $userId = null;
                if ($validated['user_mode'] === 'new') {
                    $user = \App\Models\User::create([
                        'Ho_ten' => $validated['Ho_ten'],
                        'Email' => $validated['new_user_email'],
                        'Mat_khau_hash' => \Illuminate\Support\Facades\Hash::make($validated['new_user_password']),
                        'So_dien_thoai' => $validated['So_dien_thoai'],
                        'Loai_tai_khoan' => 'user',
                        'Trang_thai' => 'active',
                    ]);
                    $userId = $user->Ma_nguoi_dung;
                } else {
                    $userId = $validated['Ma_nguoi_dung'];
                }

                // Tạo đơn
                $application = AdoptionApplication::create([
                    'Ma_nguoi_dung'   => $userId,
                    'Ma_thu_cung'     => $validated['Ma_thu_cung'],
                    'Ho_ten'          => $validated['Ho_ten'],
                    'So_dien_thoai'   => $validated['So_dien_thoai'],
                    'Dia_chi'         => $validated['Dia_chi'],
                    'Nghe_nghiep'     => $validated['Nghe_nghiep'] ?? null,
                    'Loai_nha_o'      => $validated['Loai_nha_o'] ?? null,
                    'Kinh_nghiem'     => $validated['Kinh_nghiem'] ?? null,
                    'Ly_do_nhan_nuoi' => $validated['Ly_do_nhan_nuoi'],
                    'Cam_ket'         => true,
                    'Trang_thai'      => 'completed',
                    'Ghi_chu_admin'   => $validated['Ghi_chu_admin'] ?? null,
                ]);

                // Nếu hoàn tất luôn (mặc định cho admin tạo mới)
                $pet->update(['Trang_thai' => 'da_nhan_nuoi']);
                
                // Từ chối các đơn khác (nếu có)
                    AdoptionApplication::where('Ma_thu_cung', $pet->Ma_thu_cung)
                        ->whereIn('Trang_thai', ['pending', 'approved', 'cho_phong_van'])
                        ->where('Ma_don', '!=', $application->Ma_don)
                        ->update([
                            'Trang_thai'    => 'rejected',
                            'Ghi_chu_admin' => 'Hệ thống tự động từ chối: Bé đã được nhận nuôi.',
                        ]);
            });

            return redirect()->route('admin.adoptions.index')->with('success', 'Đã tạo đơn nhận nuôi thành công!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Chi tiết đơn nhận nuôi
     */
    public function show($id)
    {
        $application = AdoptionApplication::with([
            'thuCung.lichSuTiemChung',
            'nguoiDung',
            'answers.question',
        ])->findOrFail($id);

        return view('admin.adoptions.show', compact('application'));
    }

    /**
     * Chỉnh sửa đơn nhận nuôi (chuyển hướng sang trang chi tiết để xử lý)
     */
    public function edit($id)
    {
        return redirect()->route('admin.adoptions.show', $id);
    }

    /**
     * Cập nhật trạng thái đơn (duyệt, từ chối, duyệt sơ bộ)
     */
    public function update(Request $request, $id)
    {
        $application = AdoptionApplication::with('thuCung')->findOrFail($id);

        $newStatus = $request->input('Trang_thai');
        $ghiChu = $request->input('Ghi_chu_admin');

        $currentStatus = $application->Trang_thai;

        if ($newStatus === $currentStatus) {
            $application->update(['Ghi_chu_admin' => $ghiChu]);
            return back()->with('success', 'Đã cập nhật ghi chú thành công.');
        }

        if ($newStatus === 'tu_choi' && empty($ghiChu)) {
            return back()->withErrors(['Ghi_chu_admin' => 'Vui lòng nhập lý do từ chối.'])->withInput();
        }

        // Bước 2: Duyệt sơ bộ
        if ($newStatus === 'cho_xac_nhan_don' && $currentStatus === 'cho_duyet') {
            return $this->approveApplication($application, $ghiChu);
        }

        // Bước 6: Hoàn tất (Đã bàn giao)
        if ($newStatus === 'hoan_thanh' && $currentStatus === 'da_duyet') {
            return $this->completeApplication($application, $ghiChu);
        }

        // Nếu từ chối (bất kỳ bước nào)
        if ($newStatus === 'tu_choi') {
            return $this->rejectApplication($application, $ghiChu);
        }

        // Cập nhật thông thường
        $application->update([
            'Trang_thai'    => $newStatus,
            'Ghi_chu_admin' => $ghiChu,
        ]);

        return redirect()->route('admin.adoptions.show', $id)->with('success', "Đã cập nhật đơn nhận nuôi thành công!");
    }

    private function approveApplication(AdoptionApplication $application, ?string $ghiChu)
    {
        try {
            DB::transaction(function () use ($application, $ghiChu) {
                $pet = Pet::where('Ma_thu_cung', $application->Ma_thu_cung)->lockForUpdate()->first();
                if (!$pet || $pet->Trang_thai !== 'san_sang') {
                    throw new \Exception('Bé này không còn sẵn sàng nhận nuôi.');
                }
                $application->update([
                    'Trang_thai' => 'cho_xac_nhan_don',
                    'Ghi_chu_admin' => $ghiChu,
                    'han_xac_nhan_phong_van' => now()->addHours(24),
                ]);
            });

            // Gửi email Mời phỏng vấn
            $application->load(['nguoiDung', 'thuCung']);
            if ($application->nguoiDung && $application->nguoiDung->email) {
                Mail::to($application->nguoiDung->email)->send(new InterviewInvitationEmail($application));
            }

            return back()->with('success', 'Đã duyệt sơ bộ! Hệ thống đã gửi email mời chọn lịch phỏng vấn (Hạn 24h).');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    private function rejectApplication(AdoptionApplication $application, ?string $ghiChu)
    {
        try {
            $application->update([
                'Trang_thai' => 'tu_choi',
                'Ghi_chu_admin' => $ghiChu,
            ]);

            $application->load(['nguoiDung', 'thuCung']);
            if ($application->nguoiDung && $application->nguoiDung->email) {
                Mail::to($application->nguoiDung->email)->send(new ApplicationRejectedEmail($application, $ghiChu));
            }
            return back()->with('success', 'Đã từ chối đơn và gửi email thông báo tới người dùng.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    private function completeApplication(AdoptionApplication $application, ?string $ghiChu)
    {
        try {
            $application->update([
                'Trang_thai'    => 'hoan_thanh',
                'Ghi_chu_admin' => $ghiChu,
            ]);
            // Trạng thái pet đã là da_nhan_nuoi từ bước 5, nên không cần sửa.
            
            return back()->with('success', 'Đã xác nhận bàn giao thành công. Hoàn tất quy trình!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Xóa đơn nhận nuôi (chỉ admin, chỉ khi cancelled/rejected)
     */
    public function destroy($id)
    {
        $application = AdoptionApplication::findOrFail($id);

        if (!in_array($application->Trang_thai, ['rejected'])) {
            return redirect()
                ->route('admin.adoptions.index')
                ->with('error', 'Chỉ có thể xóa đơn đã từ chối.');
        }

        $application->delete();

        return redirect()
            ->route('admin.adoptions.index')
            ->with('success', 'Đã xóa đơn nhận nuôi thành công!');
    }
}
