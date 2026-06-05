<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;

class MailService
{
    /**
     * Gửi email sử dụng PHPMailer
     * 
     * @param string $to Địa chỉ email người nhận
     * @param string $subject Tiêu đề email
     * @param string $body Nội dung email (HTML)
     * @param string $altBody Nội dung email (Text thuần)
     * @return bool
     */
    public function send($to, $subject, $body, $altBody = '')
    {
        $mail = new PHPMailer(true);

        try {
            // Cấu hình Server SMTP
            $mail->isSMTP();
            $mail->Host       = env('MAIL_HOST', 'smtp.gmail.com');
            $mail->SMTPAuth   = true;
            $mail->Username   = env('MAIL_USERNAME');
            $mail->Password   = env('MAIL_PASSWORD');
            
            $encryption = env('MAIL_ENCRYPTION', 'tls');
            if ($encryption === 'tls') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            } elseif ($encryption === 'ssl') {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // default fallback
            }
            
            $mail->Port       = env('MAIL_PORT', 587);
            
            // Fix SSL issues on some local environments
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Người gửi và Người nhận
            $mail->setFrom(env('MAIL_FROM_ADDRESS', 'no-reply@petjam.com'), env('MAIL_FROM_NAME', 'PetJam'));
            $mail->addAddress($to);

            // Nội dung - bọc trong template đẹp
            $htmlBody = view('emails.template', [
                'subject' => $subject,
                'content' => $body
            ])->render();

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $htmlBody;
            $mail->AltBody = $altBody ?: strip_tags($body);
            
            // Hỗ trợ tiếng Việt
            $mail->CharSet = 'UTF-8';

            $mail->send();
            return true;
        } catch (Exception $e) {
            Log::error("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}
