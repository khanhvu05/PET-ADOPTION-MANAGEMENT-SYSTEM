<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\AdoptionApplication;

class InterviewReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    public function __construct(AdoptionApplication $application)
    {
        $this->application = $application;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nhắc Nhở Chọn Lịch Phỏng Vấn (Sắp Hết Hạn)',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.interview_reminder',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
