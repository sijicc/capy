<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Validator;

readonly class CreateUser
{
    public function handle(array $user): User
    {
        return User::create($user);
    }
}
