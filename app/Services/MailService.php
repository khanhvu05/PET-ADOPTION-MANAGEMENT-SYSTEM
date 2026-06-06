<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Throwable;

class MailService
{
    /**
     * Gửi email sử dụng hệ thống Mail mặc định của Laravel
     * 
     * @param string $to Địa chỉ email người nhận
     * @param string $subject Tiêu đề email
     * @param string $body Nội dung email (HTML)
     * @param string $altBody Nội dung email (Text thuần)
     * @return bool
     */
    public function send($to, $subject, $body, $altBody = '')
    {
        try {
            Mail::send('emails.template', [
                'subject' => $subject,
                'content' => $body
            ], function ($message) use ($to, $subject) {
                $message->to($to)
                        ->subject($subject);
            });
            
            return true;
        } catch (Throwable $e) {
            Log::error("Message could not be sent. Mailer Error: {$e->getMessage()}");
            return false;
        }
    }
}
