<?php

namespace App\Actions;

use App\Models\Company;
use App\Rules\NipRule;
use App\Rules\RegonRule;
use Validator;

readonly class EditCompany
{
    public function __construct(
        private EditAddress $editAddress = new EditAddress(),
    ) {
    }

    public function handle(Company $company, array $changes): Company
    {
        $validated = $this->validate($changes, $company);

        $company->update($validated);
        $this->editAddress->handle($company->address, $changes['address']);
        $this->editAddress->handle($company->correspondenceAddress, $changes['correspondence_address']);

        return $company;
    }

    protected function validate(array $changes, Company $company): array
    {
        return Validator::make($changes, [
            'name' => ['required', 'max:255'],
            'nip' => ['required', new NipRule(), "unique:companies,nip,{$company->id}"],
            'regon' => ['required', new RegonRule(), "unique:companies,regon,{$company->id}"],
            'krs' => ['max:10', 'nullable'],
            'website' => ['nullable', 'url'],
        ])->validate();
    }
}
