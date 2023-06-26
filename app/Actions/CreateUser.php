<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Validator;

class CreateUser
{
    public function handle(array $user): User
    {
        $validated = $this->validate($user);

        return User::create($validated);
    }

    protected function validate(array $user): array
    {
        return Validator::make($user, [
            'name' => ['required', 'string', 'max:255'],
            'password' => [
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers(),
            ],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ])->validate();
    }
}
