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
                $body = view('emails.partials.interview_choose_reminder', [
                    'user' => $app->nguoiDung,
                    'application' => $app
                ])->render();

                $mailService->send($app->nguoiDung->email, $subject, $body);
            }
            $count++;
        }

        $this->info("Đã gửi nhắc nhở thành công cho {$count} đơn.");
        Log::info("Cronjob adoptions:remind-unconfirmed ran. Reminded {$count} users.");
    }
}
