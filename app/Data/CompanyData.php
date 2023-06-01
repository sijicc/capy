<?php

namespace App\Data;

use App\Rules\NipRule;
use App\Rules\RegonRule;
use Spatie\LaravelData\Data;

class CompanyData extends Data
{
    public function __construct(
        public string $name,
        public string $nip,
        public string $regon,
        public ?string $krs,
        public AddressData $address,
        public AddressData $correspondenceAddress,
        public ?string $website = null,
    ) {
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'nip' => ['required', new NipRule(), 'unique:companies,nip'],
            'regon' => ['required', new RegonRule(), 'unique:companies,regon'],
            'krs' => ['max:10', 'string', 'nullable'],
            'website' => ['nullable', 'url'],
        ];
    }
}
