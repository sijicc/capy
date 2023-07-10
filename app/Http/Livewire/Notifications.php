<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Notifications extends Component
{
    public function getListeners(): array
    {
        $id = auth()->id();
        return [
            "echo-private:App.Models.User.{$id},.Illuminate\Notifications\Events\BroadcastNotificationCreated" => 'updateNotifications',
        ];
    }

    public $notifications = [];

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

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.notifications');
    }
}
