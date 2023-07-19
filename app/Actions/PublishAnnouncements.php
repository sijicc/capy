<?php

namespace App\Actions;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Collection;

class PublishAnnouncements
{
    public Collection $announcements;

    public function __construct()
    {
        $this->announcements = Announcement::where('publish_at', '<=', now())
            ->whereNull('published_at')
            ->get();
    }

    public function __invoke(): void
    {
        $this->announcements->each(fn (Announcement $announcement) => $announcement->publish());
    }
}
