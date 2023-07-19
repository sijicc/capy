<?php

namespace App\Notifications;

use App\Mail\NewAnnouncementMail;
use App\Models\Announcement;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewAnnouncementNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $message;

    public function __construct(
        public Announcement $announcement,
    ) {
        $this->message = __('notifications.new_announcement', [
            'user' => $this->announcement->user->name,
            'title' => $this->announcement->title,
        ]);
    }

    /**
     * @throws Exception
     */
    public function via($notifiable): array
    {
        $via = ['database'];

        if ($this->announcement->should_email) {
            $via[] = 'mail';
        }

        if ($this->announcement->should_notify) {
            $via[] = 'broadcast';
        }

        if (count($via) === 0) {
            throw new Exception('No notification methods selected.');
        }

        return $via;
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => $this->message,
        ]);
    }

    public function toArray($notifiable): array
    {
        return [
            'announcement_id' => $this->announcement->id,
            'message' => $this->message,
            'body' => $this->announcement->content,
        ];
    }

    public function toMail($notifiable): NewAnnouncementMail
    {
        return (new NewAnnouncementMail($this->announcement))->to($notifiable->email);
    }
}
