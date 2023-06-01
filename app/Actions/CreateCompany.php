<?php

namespace App\Actions;

use App\Data\CompanyData;
use App\Models\Company;

class CreateCompany
{
    public function handle(array|CompanyData $company): Company
    {
        CompanyData::validate($company);

        $createAddress = new CreateAddress();

        if (! ($company instanceof CompanyData)) {
            $company = CompanyData::from($company);
        }

        return Company::create(array_merge($company->toArray(), [
            'address_id' => $createAddress->handle($company->address)->id,
            'correspondence_address_id' => $createAddress->handle($company->correspondenceAddress)->id,
        ]));
    }
}
