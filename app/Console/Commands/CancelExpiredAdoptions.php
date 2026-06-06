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

        /** @var \App\Models\AdoptionApplication $app */
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
                $body = view('emails.partials.adoption_failed', [
                    'user' => $app->nguoiDung,
                    'application' => $app,
                    'ghiChu' => 'Hệ thống tự động hủy đơn do quá hạn 24h không xác nhận lịch phỏng vấn.'
                ])->render();

                $mailService->send($app->nguoiDung->email, $subject, $body);
            }
            $count++;
        }

        $this->info("Đã hủy thành công {$count} đơn quá hạn.");
        Log::info("Cronjob adoptions:cancel-expired ran. Cancelled {$count} applications.");
    }
}
