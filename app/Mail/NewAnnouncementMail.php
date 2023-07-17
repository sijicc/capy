<?php

namespace App\Mail;

use App\Models\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewAnnouncementMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Announcement $announcement,
    )
    {
    }

    public function envelope(): Envelope
    {
        $subject = __('notifications.new_announcement', [
            'user' => $this->announcement->user->name,
            'title' => $this->announcement->title,
        ]);

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.new-announcement',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
