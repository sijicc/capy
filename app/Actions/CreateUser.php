<?php

namespace App\Actions;

use App\Data\UserData;
use App\Models\User;

class CreateUser
{
    public function handle(array|UserData $user): User
    {
        UserData::validate($user);

        if(!($user instanceof UserData)) {
            $user = UserData::from($user);
        }

        return User::create($user->toArray());
    }
}
