<?php

namespace App\Actions;

use App\Data\UserData;
use App\Models\User;

class CreateUser
{
    public function handle(array $user): User
    {
        $user = UserData::validateAndCreate($user);

        return User::create($user->toArray());
    }
}
