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

        $perPage = $request->input('per_page', 8);
        $applications = $query->paginate($perPage)->withQueryString();

        // Stats thật
        $stats = [
            'total'        => AdoptionApplication::count(),
            'pending'      => AdoptionApplication::whereIn('Trang_thai', ['pending', 'pre_approved'])->count(),
            'approved'     => AdoptionApplication::where('Trang_thai', 'approved')->count(),
            'completed'    => AdoptionApplication::where('Trang_thai', 'completed')->count(),
            'rejected'     => AdoptionApplication::where('Trang_thai', 'rejected')->count(),
            'cancelled'    => AdoptionApplication::where('Trang_thai', 'cancelled')->count(),
        ];

        return view('admin.adoptions.index', compact('applications', 'stats'));
    }

    /**
     * Form tạo đơn mới (admin tự tạo - hiếm khi dùng)
     */
    public function create()
    {
        $pets = Pet::where('Trang_thai', 'san_sang')->orderBy('Ten')->get();
        return view('admin.adoptions.create', compact('pets'));
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
     * Cập nhật trạng thái đơn (duyệt, từ chối, duyệt sơ bộ)
     */
    public function update(Request $request, $id)
    {
        $application = AdoptionApplication::with('thuCung')->findOrFail($id);

        $newStatus = $request->input('Trang_thai');
        $ghiChu = $request->input('Ghi_chu_admin');

        // Validate state machine transitions
        $allowedTransitions = [
            'pending'      => ['approved', 'rejected'], // Bỏ qua pre_approved, cho phép duyệt thẳng
            'pre_approved' => ['approved', 'rejected'],
            'approved'     => ['completed', 'cancelled'], // Đã duyệt có thể hoàn tất hoặc bị hủy (bởi user/hệ thống)
            'cho_phong_van'=> ['completed', 'cancelled', 'rejected'], // Chờ phỏng vấn có thể hoàn tất, hủy, hoặc rớt phỏng vấn (từ chối)
            'completed'    => [], // Hoàn tất rồi thì đóng
            'rejected'     => [], // Đã từ chối không cho đổi
            'cancelled'    => [], // Đã hủy không cho đổi
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

        // Nếu hủy hoặc từ chối một đơn đã approved hoặc cho_phong_van, đưa pet quay lại trạng thái sẵn sàng
        if (in_array($newStatus, ['cancelled', 'rejected']) && in_array($application->Trang_thai, ['approved', 'cho_phong_van'])) {
            $petToRevert = \App\Models\Pet::find($application->Ma_thu_cung);
            if ($petToRevert && $petToRevert->Trang_thai === 'cho_phong_van') {
                $petToRevert->update(['Trang_thai' => 'san_sang']);
            }
        }

        // Các trường hợp khác: đơn giản cập nhật
        $application->update([
            'Trang_thai'    => $newStatus,
            'Ghi_chu_admin' => $ghiChu,
        ]);

        $label = match ($newStatus) {
            'pre_approved' => 'Đã duyệt sơ bộ',
            'rejected'     => 'Đã từ chối',
            default        => 'Đã cập nhật',
        };

        // Gửi email thông báo hủy/từ chối
        if (in_array($newStatus, ['rejected', 'cancelled'])) {
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
                                $body .= "<p>Rất tiếc, sau buổi phỏng vấn, chúng tôi nhận thấy điều kiện hiện tại của bạn chưa thực sự phù hợp để nhận nuôi bé vào lúc này. Vì vậy, chúng tôi đành phải thông báo rằng buổi phỏng vấn chưa thành công với lý do chi tiết như sau:</p>";
                            } else {
                                $body .= "<p>Rất tiếc, sau khi xem xét, chúng tôi không thể phê duyệt đơn nhận nuôi của bạn với lý do:</p>";
                            }
                        } else {
                            $body .= "<p>Đơn nhận nuôi của bạn đã bị hủy bỏ bởi hệ thống/quản trị viên với lý do:</p>";
                        }

                        if ($ghiChuEmail) {
                            $body .= "<blockquote style='background: #f9f9f9; border-left: 4px solid #ccc; margin: 1.5em 10px; padding: 0.5em 10px;'>{$ghiChuEmail}</blockquote>";
                        } else {
                            $body .= "<blockquote style='background: #f9f9f9; border-left: 4px solid #ccc; margin: 1.5em 10px; padding: 0.5em 10px;'>Không đạt yêu cầu hoặc vi phạm quy định nhận nuôi.</blockquote>";
                        }
                        
                        $body .= "<p>Hy vọng bạn sẽ tìm được một người bạn đồng hành phù hợp khác trong tương lai.</p>";
                        $body .= "<br><p>Trân trọng,<br>PetJam Team</p>";
                        
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
                        $body = "<h2>Xin chào {$application->nguoiDung->Ho_ten},</h2>";
                        $body .= "<p>PetJam xin chúc mừng bạn! Đơn đăng ký nhận nuôi bé <strong>{$petName}</strong> của bạn đã chính thức được <strong>phê duyệt</strong>.</p>";
                        if ($ghiChuEmail) {
                            $body .= "<p><strong>Ghi chú từ quản trị viên:</strong> {$ghiChuEmail}</p>";
                        }
                        $body .= "<p>Để hoàn tất thủ tục, bạn vui lòng truy cập vào lịch sử nhận nuôi và chọn lịch phỏng vấn/đón bé với chúng tôi trong vòng 24 giờ tới. Nếu quá hạn, đơn của bạn sẽ bị hủy tự động.</p>";
                        $body .= "<p><a href='" . route('frontend.user.adoptions.index') . "' style='display:inline-block;padding:10px 20px;background:#F58A3C;color:#fff;text-decoration:none;border-radius:5px;'>Chọn lịch phỏng vấn ngay</a></p>";
                        $body .= "<br><p>Trân trọng,<br>PetJam Team</p>";
                        
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
                ->whereIn('Trang_thai', ['pending', 'pre_approved'])
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
                foreach ($rejectedApps as $app) {
                    $app->update([
                        'Trang_thai'    => 'rejected',
                        'Ghi_chu_admin' => 'Hệ thống tự động từ chối: Bé đã được nhận nuôi thành công bởi một người khác.',
                    ]);
                }
            });

            $application->load(['nguoiDung', 'thuCung']);
            
            app()->terminating(function () use ($application, $rejectedApps) {
                $mailService = app(MailService::class);
                
                // Gửi email xác nhận hoàn tất
                try {
                    if ($application->nguoiDung && $application->nguoiDung->email) {
                        $petName = $application->thuCung->Ten ?? 'thú cưng';
                        
                        $subject = "Chúc mừng! Bạn đã chính thức nhận nuôi bé {$petName}";
                        $body = "<h2>Xin chào {$application->nguoiDung->Ho_ten},</h2>";
                        $body .= "<p>PetJam xin chúc mừng bạn đã hoàn tất thủ tục và đón bé <strong>{$petName}</strong> về nhà mới thành công!</p>";
                        $body .= "<p>Chúc bạn và bé có những khoảnh khắc tuyệt vời bên nhau. Nếu có bất kỳ thắc mắc hay cần hỗ trợ nào trong quá trình chăm sóc bé, đừng ngần ngại liên hệ với chúng tôi.</p>";
                        $body .= "<br><p>Trân trọng,<br>PetJam Team</p>";
                        
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
                            $body = "<h2>Xin chào {$app->nguoiDung->Ho_ten},</h2>";
                            $body .= "<p>Cảm ơn bạn đã quan tâm và đăng ký nhận nuôi bé <strong>{$petName}</strong> tại PetJam.</p>";
                            $body .= "<p>Rất tiếc, đơn nhận nuôi của bạn đã bị từ chối tự động với lý do:</p>";
                            $body .= "<blockquote style='background: #f9f9f9; border-left: 4px solid #ccc; margin: 1.5em 10px; padding: 0.5em 10px;'>Bé đã được nhận nuôi thành công bởi một người khác nhanh tay hơn.</blockquote>";
                            $body .= "<p>Hy vọng bạn sẽ tiếp tục theo dõi và tìm được một người bạn đồng hành phù hợp khác trong tương lai tại PetJam.</p>";
                            $body .= "<br><p>Trân trọng,<br>PetJam Team</p>";
                            
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

        if (!in_array($application->Trang_thai, ['cancelled', 'rejected'])) {
            return redirect()
                ->route('admin.adoptions.index')
                ->with('error', 'Chỉ có thể xóa đơn đã hủy hoặc đã từ chối.');
        }

        $application->delete();

        return redirect()
            ->route('admin.adoptions.index')
            ->with('success', 'Đã xóa đơn nhận nuôi thành công!');
    }
}
