<?php

namespace App\Actions;

use App\Models\Announcement;
use Validator;

class EditAnnouncement
{
    public function handle(Announcement $announcement, array $changes): Announcement
    {
        $announcement->update($this->validate($changes, $announcement));

        return $announcement;
    }

    protected function validate(array $changes, Announcement $announcement): array
    {
        return Validator::make($changes, [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:255'],
            'should_notify' => ['nullable', 'boolean'],
            'should_email' => ['nullable', 'boolean'],
            'publish_at' => ['nullable', 'date', 'after_or_equal:today'],
        ])->validate();
    }
}
