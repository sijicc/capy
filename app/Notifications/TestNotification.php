<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class TestNotification extends Notification
{
    public function __construct()
    {
    }

    public function via($notifiable): array
    {
        return ['broadcast', 'database'];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => '<a href="' . route('companies.create') . '">Hello World!</a>',
        ]);
    }

    public function toArray($notifiable): array
    {
        return [
            'message' => '<a href="' . route('companies.create') . '">Hello World!</a>',
        ];
    }
}
