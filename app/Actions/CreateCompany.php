<?php

namespace App\Actions;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Validator;

readonly class CreateCompany
{
    public function __construct(
        public CreateAddress $createAddress = new CreateAddress(),
    )
    {
    }

    public function handle(array $company): Company
    {
        $validated = Validator::make($company, (new CompanyRequest())->rules())->validate();

        $validated['address_id'] = $this->createAddress->handle(
            address: $company['address'] ?? []
        )->id;
        $validated['correspondence_address_id'] = $this->createAddress->handle(
            address: $company['correspondence_address'] ?? []
        )->id;

        return Company::create($validated);
    }
}
