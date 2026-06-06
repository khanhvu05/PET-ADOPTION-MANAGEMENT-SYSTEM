<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\AdoptionApplication;

class NewAdoptionApplication extends Notification
{
    use Queueable;

    protected $application;

    /**
     * Create a new notification instance.
     */
    public function __construct(AdoptionApplication $application)
    {
        $this->application = $application;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Đơn nhận nuôi mới',
            'message' => 'Người dùng ' . ($this->application->nguoiDung->Ho_ten ?? 'ẩn danh') . ' vừa gửi đơn xin nhận nuôi thú cưng ' . ($this->application->thuCung->Ten_thu_cung ?? ''),
            'url' => route('admin.adoptions.show', $this->application->Ma_don),
        ];
    }
}
