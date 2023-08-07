<?php

namespace App\Actions;

use App\Models\Company;

readonly class CreateCompany
{
    public function __construct(
        public CreateAddress $createAddress = new CreateAddress(),
    ) {
    }

    public function handle(array $company): Company
    {
        $company['address_id'] = $this->createAddress->handle(
            address: $company['address'] ?? []
        )->id;
        $company['correspondence_address_id'] = $this->createAddress->handle(
            address: $company['correspondence_address'] ?? []
        )->id;

        return Company::create($company);
    }
}
