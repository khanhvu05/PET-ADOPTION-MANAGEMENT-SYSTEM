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
    }
}
