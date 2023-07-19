<?php

namespace App\Actions;

use App\Models\Company;
use App\Rules\NipRule;
use App\Rules\RegonRule;
use Validator;

readonly class CreateCompany
{
    public function __construct(
        public CreateAddress $createAddress = new CreateAddress(),
    ) {
    }

    public function handle(array $company): Company
    {
        $validated = $this->validate($company);

        $validated['address_id'] = $this->createAddress->handle(
            address: $company['address'] ?? []
        )->id;
        $validated['correspondence_address_id'] = $this->createAddress->handle(
            address: $company['correspondence_address'] ?? []
        )->id;

        return Company::create($validated);
    }

    protected function validate(array $company): array
    {
        return Validator::make($company, [
            'name' => ['required', 'max:255'],
            'nip' => ['required', new NipRule(), 'unique:companies,nip'],
            'regon' => ['required', new RegonRule(), 'unique:companies,regon'],
            'krs' => ['max:10', 'nullable'],
            'website' => ['nullable', 'url'],
        ])->validate();
    }
}
