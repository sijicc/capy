<?php

namespace App\Actions;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Validator;

readonly class EditCompany
{
    public function __construct(
        private EditAddress $editAddress = new EditAddress(),
        private CompanyRequest $companyRequest = new CompanyRequest(),
    )
    {
    }

    public function handle(Company $company, array $changes): Company
    {
        $rules = $this->companyRequest->rules();
        $rules['nip'][2] .= ','.$company->id;
        $rules['regon'][2] .= ','.$company->id;

        $validated = Validator::make($changes, $rules)->validated();

        $company->update($validated);
        $this->editAddress->handle($company->address, $changes['address']);
        $this->editAddress->handle($company->correspondenceAddress, $changes['correspondenceAddress']);

        return $company;
    }
}
