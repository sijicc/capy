<?php

namespace App\Actions;

use App\Models\User;

readonly class EditUser
{
    public function handle(User $user, array $changes): User
    {
        if ($changes['password'] === null) {
            unset($changes['password']);
        }

        $user->update($changes);

        return $user;
    }
}
