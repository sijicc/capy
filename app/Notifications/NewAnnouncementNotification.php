<?php

namespace App\Notifications;

use App\Mail\NewAnnouncementMail;
use App\Models\Announcement;
use App\Models\User;
use Exception;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Events\DatabaseNotificationsSent;
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
    )
    {
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

        return $via;
    }

    public function toBroadcast(User $notifiable): BroadcastMessage
    {
        event(new DatabaseNotificationsSent($notifiable));
        return \Filament\Notifications\Notification::make()
            ->info()
            ->title($this->message)
            ->actions([
                Action::make('view')
                    ->url(route('announcements.show', $this->announcement)),
            ])
            ->getBroadcastMessage();
    }

    public function toArray($notifiable): array
    {
        return [
            'announcement_id' => $this->announcement->id,
            'message' => $this->message,
            'body' => $this->announcement->content,
        ];
    }

    public function toDatabase(): array
    {
        return \Filament\Notifications\Notification::make()
            ->info()
            ->title($this->message)
            ->actions([
                Action::make('view')
                    ->url(route('announcements.show', $this->announcement)),
            ])
            ->getDatabaseMessage();
    }

    public function toMail($notifiable): NewAnnouncementMail
    {
        return (new NewAnnouncementMail($this->announcement))->to($notifiable->email);
    }
}
