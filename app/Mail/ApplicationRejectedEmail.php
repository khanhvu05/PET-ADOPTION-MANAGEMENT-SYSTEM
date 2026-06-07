<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\AdoptionApplication;

class ApplicationRejectedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $reason;

    public function __construct(AdoptionApplication $application, $reason)
    {
        $this->application = $application;
        $this->reason = $reason;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thông báo kết quả hồ sơ nhận nuôi',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application_rejected',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
