<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mailer\Bridge\Brevo\Transport\BrevoTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production' || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Cấp toàn quyền cho role 'admin' bỏ qua mọi kiểm tra permission
        \Illuminate\Support\Facades\Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });

        // Đăng ký custom transport cho Brevo API để lách tường lửa Render
        Mail::extend('brevo', function (array $config) {
            $factory = new BrevoTransportFactory();
            // DSN format: brevo+api://KEY@default
            // Sử dụng MAIL_PASSWORD (hoặc API_KEY)
            $apiKey = $config['api_key'] ?? env('MAIL_PASSWORD');
            
            return $factory->create(new Dsn(
                'brevo+api',
                'default',
                $apiKey
            ));
        });

        \Illuminate\Support\Facades\Event::listen(
            \Illuminate\Auth\Events\PasswordReset::class,
            \App\Listeners\SendPasswordResetNotification::class
        );

        // Tự động sinh tiêu đề trang (title) dựa vào tên route
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $title = 'Animal Adoption & Rescue'; // Default
            $route = request()->route();
            if ($route) {
                $name = $route->getName() ?? '';
                
                $map = [
                    'home' => 'Trang chủ',
                    'login' => 'Đăng nhập',
                    'register' => 'Đăng ký',
                    'password.request' => 'Quên mật khẩu',
                    'password.reset' => 'Đặt lại mật khẩu',
                    'verification.notice' => 'Xác thực Email',
                    'profile.edit' => 'Cài đặt Tài khoản',
                    'frontend.user.adoptions.index' => 'Lịch sử nhận nuôi',
                    'frontend.user.donations.index' => 'Lịch sử ủng hộ',
                    'frontend.adoptions.index' => 'Nhận nuôi thú cưng',
                    'frontend.adoptions.show' => 'Chi tiết thú cưng',
                    'frontend.adoptions.create' => 'Gửi đơn nhận nuôi',
                    'frontend.donations.index' => 'Ủng hộ quỹ',
                    'frontend.donations.process' => 'Thực hiện ủng hộ',
                    'frontend.donations.process.campaign' => 'Thực hiện ủng hộ',
                    'frontend.donations.vnpay.return' => 'Kết quả thanh toán',
                    'dashboard' => 'Bảng điều khiển',
                    'admin.search' => 'Tìm kiếm',
                    'admin.notifications.index' => 'Thông báo',
                ];

                if (isset($map[$name])) {
                    $title = $map[$name];
                } else {
                    if (str_starts_with($name, 'admin.pets.')) $title = 'Quản lý Thú cưng';
                    elseif (str_starts_with($name, 'admin.adoptions.')) $title = 'Đơn nhận nuôi';
                    elseif (str_starts_with($name, 'admin.users.')) $title = 'Quản lý Người dùng';
                    elseif (str_starts_with($name, 'admin.roles.')) $title = 'Quản lý Phân quyền';
                    elseif (str_starts_with($name, 'admin.posts.')) $title = 'Quản lý Bài đăng';
                    elseif (str_starts_with($name, 'admin.donation_campaigns.')) $title = 'Chiến dịch gây quỹ';
                    elseif (str_starts_with($name, 'admin.donations.')) $title = 'Quản lý Ủng hộ';
                    elseif (str_starts_with($name, 'admin.interview_schedules.')) $title = 'Lịch phỏng vấn';
                    elseif (str_starts_with($name, 'admin.settings.')) $title = 'Cài đặt hệ thống';
                }
            }
            $view->with('autoPageTitle', $title);
        });
    }
}
