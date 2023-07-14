<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;

    }

    public function view(User $user, Setting $setting): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Setting $setting): bool
    {
        return true;
    }

    public function delete(User $user, Setting $setting): bool
    {
        return true;
    }

    public function restore(User $user, Setting $setting): bool
    {
        return true;
    }

    public function forceDelete(User $user, Setting $setting): bool
    {
        return true;
    }
}
