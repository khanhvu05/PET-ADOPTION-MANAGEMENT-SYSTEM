<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdoptionApplication;
use App\Services\MailService;
use Illuminate\Support\Facades\Log;

class CancelExpiredAdoptions extends Command
{
    protected $signature = 'adoptions:cancel-expired';
    protected $description = 'Hủy các đơn nhận nuôi đã được duyệt nhưng quá 24h không chọn lịch phỏng vấn';

    public function handle(MailService $mailService)
    {
        $expiredApplications = AdoptionApplication::with(['nguoiDung', 'thuCung'])
            ->where('Trang_thai', 'approved')
            ->whereNull('interview_slot_id')
            ->whereNotNull('han_xac_nhan_phong_van')
            ->where('han_xac_nhan_phong_van', '<', now())
            ->get();

        $count = 0;

        foreach ($expiredApplications as $app) {
            $app->update([
                'Trang_thai' => 'cancelled',
                'Ghi_chu_admin' => 'Hệ thống tự động hủy do quá hạn 24h không xác nhận lịch phỏng vấn.',
                'han_xac_nhan_phong_van' => null,
            ]);

            // Gửi email báo hủy
            if ($app->nguoiDung && $app->nguoiDung->email) {
                $petName = $app->thuCung->Ten ?? 'thú cưng';
                $subject = "Thông báo hủy đơn nhận nuôi bé {$petName}";
                $body = "<h2>Xin chào {$app->nguoiDung->Ho_ten},</h2>";
                $body .= "<p>Hệ thống ghi nhận bạn đã không xác nhận lịch phỏng vấn trong vòng 24 giờ sau khi đơn nhận nuôi bé <strong>{$petName}</strong> được phê duyệt.</p>";
                $body .= "<p>Do đó, đơn đăng ký của bạn đã bị <strong>hủy tự động</strong> để nhường cơ hội cho các bạn khác.</p>";
                $body .= "<p>Nếu vẫn còn nguyện vọng nhận nuôi, bạn vui lòng theo dõi lại danh sách các bé trên website và gửi lại đơn nhé.</p>";
                $body .= "<br><p>Trân trọng,<br>PetJam Team</p>";

                $mailService->send($app->nguoiDung->email, $subject, $body);
            }
            $count++;
        }

        $this->info("Đã hủy thành công {$count} đơn quá hạn.");
        Log::info("Cronjob adoptions:cancel-expired ran. Cancelled {$count} applications.");
    }
}
