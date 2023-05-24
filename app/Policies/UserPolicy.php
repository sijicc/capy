<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('users:viewAny', User::class);
    }

    public function view(User $user, User $model): bool
    {
        return $user->can('users:view', $model);
    }

    public function create(User $user): bool
    {
        return $user->can('users:create', User::class);
    }

    public function update(User $user, User $model): bool
    {
        return $user->can('users:update', $model);
    }

    public function delete(User $user, User $model): bool
    {
        if ($user->id == $model->id) {
            return false;
        }

        return $user->can('users:delete', $model);
    }
}
