<?php

namespace App\Http\Requests;

use App\Rules\NipRule;
use App\Rules\RegonRule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'nip' => ['required', new NipRule(), 'unique:companies,nip'],
            'regon' => ['required', new RegonRule(), 'unique:companies,regon'],
            'krs' => ['max:10', 'string', 'nullable'],
            'website' => ['nullable', 'url'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
