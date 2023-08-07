<?php

namespace App\Actions;

use App\Models\Company;

readonly class EditCompany
{
    public function __construct(
        private EditAddress $editAddress = new EditAddress(),
    ) {
    }

    public function handle(Company $company, array $changes): Company
    {
        $company->update($changes);
        $this->editAddress->handle($company->address, $changes['address']);
        $this->editAddress->handle($company->correspondenceAddress, $changes['correspondence_address']);

        return $company;
    }
}
