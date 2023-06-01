<?php

namespace App\Data;

use Laravel\Fortify\Rules\Password;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', (new Password())
                ->length(8)
                ->requireUppercase()
                ->requireNumeric()
                ->requireSpecialCharacter(),
            ],
        ];
    }
}
