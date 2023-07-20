<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('roles:viewAny');
    }

    public function create(User $user): bool
    {
        return $user->can('roles:create');
    }

    public function update(User $user, Role $role): bool
    {
        if ($role->name === 'admin') {
            return false;
        }

        return $user->can('roles:update');
    }

    public function delete(User $user, Role $role): bool
    {
        if ($role->name === 'admin') {
            return false;
        }

        return $user->can('roles:delete');
    }
}
