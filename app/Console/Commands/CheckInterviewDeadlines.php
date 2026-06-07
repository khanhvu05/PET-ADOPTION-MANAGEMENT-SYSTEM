<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AdoptionApplication;
use Illuminate\Support\Facades\Mail;
use App\Mail\InterviewReminderEmail;
use App\Mail\InterviewTimeoutEmail;
use Carbon\Carbon;

class CheckInterviewDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-interview-deadlines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kiểm tra và nhắc nhở/hủy các đơn nhận nuôi chưa chọn lịch phỏng vấn quá hạn';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 1. Nhắc nhở khi còn đúng 3 giờ nữa là hết hạn (21h trôi qua kể từ lúc duyệt)
        // Lấy các đơn có han_xac_nhan_phong_van còn đúng <= 3 tiếng và chưa gửi nhắc nhở
        $applicationsToRemind = AdoptionApplication::with(['nguoiDung', 'thuCung'])
            ->where('Trang_thai', 'cho_xac_nhan_don')
            ->whereNotNull('han_xac_nhan_phong_van')
            ->where('han_xac_nhan_phong_van', '<=', Carbon::now()->addHours(3))
            ->where('han_xac_nhan_phong_van', '>', Carbon::now())
            ->where('da_gui_nhac_nho', false) // Cần thêm trường này vào DB
            ->get();

        foreach ($applicationsToRemind as $app) {
            if ($app->nguoiDung && $app->nguoiDung->email) {
                Mail::to($app->nguoiDung->email)->send(new InterviewReminderEmail($app));
                $app->update(['da_gui_nhac_nho' => true]);
                $this->info("Đã gửi email nhắc nhở cho đơn {$app->Ma_don}");
            }
        }

        // 2. Hủy các đơn đã quá hạn 24h
        $applicationsToTimeout = AdoptionApplication::with(['nguoiDung', 'thuCung'])
            ->where('Trang_thai', 'cho_xac_nhan_don')
            ->whereNotNull('han_xac_nhan_phong_van')
            ->where('han_xac_nhan_phong_van', '<=', Carbon::now())
            ->get();

        foreach ($applicationsToTimeout as $app) {
            $app->update([
                'Trang_thai' => 'tu_choi',
                'Ghi_chu_admin' => 'Hệ thống tự động hủy đơn vì quá hạn 24h không chọn lịch phỏng vấn.',
            ]);

            if ($app->nguoiDung && $app->nguoiDung->email) {
                Mail::to($app->nguoiDung->email)->send(new InterviewTimeoutEmail($app));
                $this->info("Đã hủy và gửi email cho đơn {$app->Ma_don}");
            }
        }

        $this->info('Hoàn tất quá trình kiểm tra deadline phỏng vấn.');
    }
}
