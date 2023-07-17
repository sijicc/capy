<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Livewire\Component;

class NotificationsBell extends Component
{
    public $notifications = [];

    public function getListeners(): array
    {
        $id = auth()->id();
        return [
            "echo-private:App.Models.User.{$id},.Illuminate\Notifications\Events\BroadcastNotificationCreated" => 'updateNotifications',
        ];
    }

    public function mount(): void
    {
        $this->updateNotifications();
    }

    public function markAsRead($notificationId): void
    {
        auth()->user()->notifications()->find($notificationId)->markAsRead();
        $this->updateNotifications();
    }

    public function markAsUnread($notificationId): void
    {
        auth()->user()->notifications()->find($notificationId)->markAsUnread();
        $this->updateNotifications();
    }

    public function markAllAsRead(): void
    {
        auth()->user()->unreadNotifications->markAsRead();
        $this->updateNotifications();
    }

    public function updateNotifications(): void
    {
        $this->notifications = auth()->user()->notifications;
    }

    public function render(): \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application
    {
        return view('livewire.notifications-bell');
    }
}
