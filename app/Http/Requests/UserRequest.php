<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'password' => [Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers(),
            ],
        ];

        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rules['email'] = ['required', 'string', 'email', 'max:255', "unique:users,email,{$this->user->id}"];
        } else {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
        }

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }
}
