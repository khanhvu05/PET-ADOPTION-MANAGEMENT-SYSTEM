<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdoptionApplication;
use App\Models\Pet;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'pending'      => $calcMetric(AdoptionApplication::where('Trang_thai', 'pending')),
            'approved'     => $calcMetric(AdoptionApplication::whereIn('Trang_thai', ['approved', 'cho_phong_van'])),
            'completed'    => $calcMetric(AdoptionApplication::where('Trang_thai', 'completed')),
            'rejected'     => $calcMetric(AdoptionApplication::where('Trang_thai', 'rejected')),
        ];

        return view('admin.adoptions.index', compact('applications', 'stats'));
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

        // Validate state machine transitions
        $allowedTransitions = [
            'pending'       => ['approved', 'rejected'],
            'approved'      => ['cho_phong_van', 'rejected'],
            'cho_phong_van' => ['completed', 'rejected'],
            'completed'     => [],
            'rejected'      => [],
        ];

        $currentStatus = $application->Trang_thai;

        // Chỉ kiểm tra transition nếu trạng thái thực sự thay đổi
        if ($newStatus !== $currentStatus && !in_array($newStatus, $allowedTransitions[$currentStatus] ?? [])) {
            return back()->with('error', "Không thể chuyển từ trạng thái \"{$application->trang_thai_label}\" sang trạng thái mới này.");
        }

        // Nếu trạng thái không đổi (ví dụ: chỉ cập nhật ghi chú)
        if ($newStatus === $currentStatus) {
            $application->update(['Ghi_chu_admin' => $ghiChu]);
            return back()->with('success', 'Đã cập nhật ghi chú thành công.');
        }

        // Yêu cầu ghi chú khi từ chối
        if ($newStatus === 'rejected' && empty($ghiChu)) {
            return back()->withErrors(['Ghi_chu_admin' => 'Vui lòng nhập lý do từ chối.'])->withInput();
        }

        // Nếu duyệt (approved): cần DB Transaction để đảm bảo tính nguyên tử
        if ($newStatus === 'approved') {
            return $this->approveApplication($application, $ghiChu);
        }

        // Nếu hoàn tất (completed): Cập nhật trạng thái pet thành da_nhan_nuoi, cập nhật đơn
        if ($newStatus === 'completed') {
            return $this->completeApplication($application, $ghiChu);
        }

        // Nếu từ chối một đơn đã approved hoặc cho_phong_van, đưa pet quay lại trạng thái sẵn sàng
        if ($newStatus === 'rejected' && in_array($application->Trang_thai, ['approved', 'cho_phong_van'])) {
            $petToRevert = Pet::find($application->Ma_thu_cung);
            if ($petToRevert) {
                $petToRevert->update(['Trang_thai' => 'san_sang']);
            }
        }

        // Các trường hợp khác: đơn giản cập nhật
        $application->update([
            'Trang_thai'    => $newStatus,
            'Ghi_chu_admin' => $ghiChu,
        ]);

        $label = match ($newStatus) {
            'rejected'     => 'Đã từ chối',
            default        => 'Đã cập nhật',
        };

        // Gửi email thông báo hủy/từ chối
        if ($newStatus === 'rejected') {
            $application->load(['nguoiDung', 'thuCung']);
            $ghiChuEmail = $ghiChu; // Capture for closure
            $newStatusEmail = $newStatus;
            $currentStatusEmail = $currentStatus;
            
            app()->terminating(function () use ($application, $ghiChuEmail, $newStatusEmail, $currentStatusEmail) {
                try {
                    if ($application->nguoiDung && $application->nguoiDung->email) {
                        $mailService = app(MailService::class);
                        $petName = $application->thuCung->Ten ?? 'thú cưng';
                        
                        $subject = "Thông báo kết quả đơn nhận nuôi bé {$petName}";
                        $body = "<h2>Xin chào {$application->nguoiDung->Ho_ten},</h2>";
                        $body .= "<p>Cảm ơn bạn đã quan tâm và đăng ký nhận nuôi bé <strong>{$petName}</strong> tại PetJam.</p>";
                        
                        if ($newStatusEmail === 'rejected') {
                            if ($currentStatusEmail === 'cho_phong_van') {
                                $body = view('emails.partials.interview_failed', [
                                    'user' => $application->nguoiDung,
                                    'application' => $application,
                                    'ghiChu' => $ghiChuEmail
                                ])->render();
                            } else {
                                $body = view('emails.partials.adoption_failed', [
                                    'user' => $application->nguoiDung,
                                    'application' => $application,
                                    'ghiChu' => $ghiChuEmail
                                ])->render();
                            }
                        } else {
                            $body = view('emails.partials.adoption_failed', [
                                'user' => $application->nguoiDung,
                                'application' => $application,
                                'ghiChu' => $ghiChuEmail ?? 'Đơn nhận nuôi của bạn đã bị hủy bỏ bởi hệ thống/quản trị viên.'
                            ])->render();
                        }

                        $mailService->send($application->nguoiDung->email, $subject, $body);
                    }
                } catch (\Exception $e) {
                    \Log::error('Lỗi gửi email từ chối/hủy: ' . $e->getMessage());
                }
            });
        }

        return redirect()
            ->route('admin.adoptions.show', $id)
            ->with('success', "{$label} đơn nhận nuôi thành công!");
    }

    /**
     * Duyệt đơn với DB Transaction - xử lý race condition
     */
    private function approveApplication(AdoptionApplication $application, ?string $ghiChu)
    {
        try {
            DB::transaction(function () use ($application, $ghiChu) {
                // Khóa pet để tránh race condition
                $pet = Pet::where('Ma_thu_cung', $application->Ma_thu_cung)
                    ->lockForUpdate()
                    ->first();

                // Kiểm tra pet còn san_sang không
                if (!$pet || $pet->Trang_thai !== 'san_sang') {
                    throw new \Exception('Bé này không còn sẵn sàng nhận nuôi. Có thể đã được nhận nuôi bởi đơn khác.');
                }

                $application->update([
                    'Trang_thai'    => 'approved',
                    'Ghi_chu_admin' => $ghiChu,
                    'han_xac_nhan_phong_van' => now()->addHours(24),
                ]);

                // Pet remains 'san_sang' until user confirms interview.

                // Tạm thời KHÔNG từ chối các đơn khác ngay lập tức vì người này có thể rớt phỏng vấn.
                // AdoptionApplication::where('Ma_thu_cung', $pet->Ma_thu_cung)
                //     ->whereIn('Trang_thai', ['pending', 'pre_approved'])
                //     ->where('Ma_don', '!=', $application->Ma_don)
                //     ->update([
                //         'Trang_thai'    => 'rejected',
                //         'Ghi_chu_admin' => 'Tự động từ chối: Bé đã được ưu tiên cho một người nhận nuôi khác.',
                //     ]);
            });

            // Gửi email chúc mừng sau khi transaction thành công
            $application->load(['nguoiDung', 'thuCung']);
            $ghiChuEmail = $ghiChu; // Capture
            app()->terminating(function () use ($application, $ghiChuEmail) {
                try {
                    if ($application->nguoiDung && $application->nguoiDung->email) {
                        $mailService = app(MailService::class);
                        $petName = $application->thuCung->Ten ?? 'thú cưng';
                        
                        $subject = "Chúc mừng! Đơn nhận nuôi bé {$petName} đã được phê duyệt";
                        $body = view('emails.partials.interview_scheduled', [
                            'user' => $application->nguoiDung,
                            'application' => $application,
                            'slot' => (object)[
                                'Ngay' => now()->addDays(3)->toDateString(), // Mock data since slot is chosen later by user
                                'Gio_bat_dau' => '09:00:00',
                                'Gio_ket_thuc' => '11:00:00',
                            ],
                            'ghiChu' => $ghiChuEmail
                        ])->render();
                        
                        $mailService->send($application->nguoiDung->email, $subject, $body);
                    }
                } catch (\Exception $e) {
                    \Log::error('Lỗi gửi email duyệt đơn: ' . $e->getMessage());
                }
            });

            return redirect()
                ->route('admin.adoptions.show', $application->Ma_don)
                ->with('success', 'Đã duyệt đơn nhận nuôi thành công! Người dùng có 24h để xác nhận lịch phỏng vấn.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Hoàn tất đơn nhận nuôi (sau khi phỏng vấn thành công)
     */
    private function completeApplication(AdoptionApplication $application, ?string $ghiChu)
    {
        try {
            // Lấy danh sách các đơn sẽ bị từ chối
            $rejectedApps = AdoptionApplication::with(['nguoiDung', 'thuCung'])
                ->where('Ma_thu_cung', $application->Ma_thu_cung)
                ->whereIn('Trang_thai', ['pending', 'approved', 'cho_phong_van'])
                ->where('Ma_don', '!=', $application->Ma_don)
                ->get();

            DB::transaction(function () use ($application, $ghiChu, $rejectedApps) {
                // Khóa pet để update trạng thái
                $pet = Pet::where('Ma_thu_cung', $application->Ma_thu_cung)
                    ->lockForUpdate()
                    ->first();

                if (!$pet) {
                    throw new \Exception('Không tìm thấy thú cưng.');
                }

                $application->update([
                    'Trang_thai'    => 'completed',
                    'Ghi_chu_admin' => $ghiChu,
                ]);

                // Chuyển thú cưng sang trạng thái đã nhận nuôi
                $pet->update(['Trang_thai' => 'da_nhan_nuoi']);

                // Từ chối các đơn pending/pre_approved khác của cùng bé thú cưng này
                /** @var \App\Models\AdoptionApplication $app */
                foreach ($rejectedApps as $app) {
                    $app->update([
                        'Trang_thai'    => 'rejected',
                        'Ghi_chu_admin' => 'Hệ thống tự động từ chối: Bé đã được nhận nuôi thành công bởi một người khác.',
                    ]);
                }
            });

            $application->load(['nguoiDung', 'thuCung']);
            $ghiChuEmail = $ghiChu;
            
            app()->terminating(function () use ($application, $rejectedApps, $ghiChuEmail) {
                $mailService = app(MailService::class);
                
                // Gửi email xác nhận hoàn tất
                try {
                    if ($application->nguoiDung && $application->nguoiDung->email) {
                        $petName = $application->thuCung->Ten ?? 'thú cưng';
                        
                        $subject = "Chúc mừng! Bạn đã chính thức nhận nuôi bé {$petName}";
                        $body = view('emails.partials.adoption_successful', [
                            'user' => $application->nguoiDung,
                            'application' => $application,
                            'ghiChu' => $ghiChuEmail
                        ])->render();
                        
                        $mailService->send($application->nguoiDung->email, $subject, $body);
                    }
                } catch (\Exception $e) {
                    \Log::error('Lỗi gửi email hoàn tất: ' . $e->getMessage());
                }

                // Gửi email cho những người bị từ chối tự động
                foreach ($rejectedApps as $app) {
                    try {
                        if ($app->nguoiDung && $app->nguoiDung->email) {
                            $petName = $app->thuCung->Ten ?? 'thú cưng';
                            $subject = "Thông báo kết quả đơn nhận nuôi bé {$petName}";
                            $body = view('emails.partials.adoption_failed', [
                                'user' => $app->nguoiDung,
                                'application' => $app,
                                'ghiChu' => 'Bé đã được nhận nuôi thành công bởi một người khác. Rất mong bạn thông cảm.'
                            ])->render();
                            
                            $mailService->send($app->nguoiDung->email, $subject, $body);
                        }
                    } catch (\Exception $e) {
                        \Log::error('Lỗi gửi email từ chối tự động: ' . $e->getMessage());
                    }
                }
            });

            return redirect()
                ->route('admin.adoptions.show', $application->Ma_don)
                ->with('success', 'Đã xác nhận hoàn tất quá trình nhận nuôi. Bé đã có chủ mới!');

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
