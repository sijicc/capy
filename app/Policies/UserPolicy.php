<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('users:viewAny');
    }

    public function view(User $user, User $model): bool
    {
        return $user->can('users:view');
    }

    public function create(User $user): bool
    {
        return $user->can('users:create');
    }

    public function update(User $user, User $model): bool
    {
        return $user->can('users:update');
    }

    public function delete(User $user, User $model): bool
    {
        if ($user->id == $model->id) {
            return false;
        }

        return $user->can('users:delete');
    }
}
