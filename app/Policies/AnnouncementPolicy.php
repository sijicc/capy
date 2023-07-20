<?php

namespace App\Policies;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('announcements:viewAny');
    }

    public function view(User $user, Announcement $announcement): bool
    {
        if ($announcement->isNotPublished()) {
            if ($user->id === $announcement->user_id) {
                return true;
            }
            if ($user->can('announcements:viewAny')) {
                return true;
            }
            return false;
        }
        return $user->can('announcements:view');
    }

    public function create(User $user): bool
    {
        return $user->can('announcements:create');
    }

    public function update(User $user, Announcement $announcement): bool
    {
        if ($announcement->isPublished()) {
            return false;
        }

        return $user->can('announcements:update');
    }

    public function delete(User $user, Announcement $announcement): bool
    {
        return $user->can('announcements:delete');
    }
}
