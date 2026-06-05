<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdoptionApplication;
use App\Services\MailService;
use Illuminate\Support\Facades\Log;

class RemindUnconfirmedAdoptions extends Command
{
    protected $signature = 'adoptions:remind-unconfirmed';
    protected $description = 'Nhắc nhở khách hàng chọn lịch phỏng vấn trước khi hết hạn 12h';

    public function handle(MailService $mailService)
    {
        // Lấy các đơn còn dưới 12h, chưa nhắc nhở
        $remindApplications = AdoptionApplication::with(['nguoiDung', 'thuCung'])
            ->where('Trang_thai', 'approved')
            ->whereNull('interview_slot_id')
            ->whereNotNull('han_xac_nhan_phong_van')
            ->where('han_xac_nhan_phong_van', '<=', now()->addHours(12))
            ->where('han_xac_nhan_phong_van', '>', now()) // chưa bị quá hạn
            ->where('da_nhac_nho_phong_van', false)
            ->get();

        $count = 0;

        foreach ($remindApplications as $app) {
            $app->update(['da_nhac_nho_phong_van' => true]);

            // Gửi email nhắc nhở
            if ($app->nguoiDung && $app->nguoiDung->email) {
                $petName = $app->thuCung->Ten ?? 'thú cưng';
                $subject = "[Nhắc nhở] Bạn chưa chọn lịch phỏng vấn cho bé {$petName}";
                $body = "<h2>Xin chào {$app->nguoiDung->Ho_ten},</h2>";
                $body .= "<p>Đây là email nhắc nhở tự động từ hệ thống PetJam.</p>";
                $body .= "<p>Đơn đăng ký nhận nuôi bé <strong>{$petName}</strong> của bạn đã được duyệt, nhưng bạn <strong>chưa chọn lịch phỏng vấn</strong>.</p>";
                $body .= "<p style='color: red; font-weight: bold;'>Bạn chỉ còn chưa đầy 12 giờ để xác nhận lịch. Hạn chót là: " . $app->han_xac_nhan_phong_van->format('H:i d/m/Y') . ".</p>";
                $body .= "<p>Vui lòng truy cập hệ thống và chọn lịch trống ngay để không bỏ lỡ cơ hội đón bé nhé!</p>";
                $body .= "<p><a href='" . route('frontend.user.adoptions.index') . "' style='display:inline-block;padding:10px 20px;background:#0AA5C0;color:#fff;text-decoration:none;border-radius:5px;'>Chọn lịch ngay</a></p>";
                $body .= "<br><p>Trân trọng,<br>PetJam Team</p>";

                $mailService->send($app->nguoiDung->email, $subject, $body);
            }
            $count++;
        }

        $this->info("Đã gửi nhắc nhở thành công cho {$count} đơn.");
        Log::info("Cronjob adoptions:remind-unconfirmed ran. Reminded {$count} users.");
    }
}
