<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\AdoptionApplication;

class InterviewPassedEmail extends Mailable
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
            subject: 'Chúc Mừng! Bạn Đã Vượt Qua Phỏng Vấn Nhận Nuôi',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.interview_passed',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
