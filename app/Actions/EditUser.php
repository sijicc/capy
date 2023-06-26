<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Validator;

class EditUser
{
    public function handle(User $user, array $changes): User
    {
        $validated = $this->validate($changes, $user);

        if ($validated['password'] === null) {
            unset($validated['password']);
        }

        $user->update($validated);

        return $user;
    }

    protected function validate(array $changes, User $user): array
    {
        return Validator::make($changes, [
            'name' => ['required', 'string', 'max:255'],
            'password' => [
                'nullable',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers(),
            ],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$user->id}"],
        ])->validate();
    }

}
