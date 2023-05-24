<?php

namespace App\Actions;

use App\Data\CompanyData;
use App\Models\Company;
use Validator;

class EditCompany
{
    public function handle(Company $company, array|CompanyData $changes): Company
    {
//        $changes = CompanyData::validate($changes);
        $rules = CompanyData::getValidationRules($changes);
        $rules['nip'][2] .= ',' . $company->id;
        $rules['regon'][2] .= ',' . $company->id;

        $changes = Validator::make($changes, $rules)->validated();

        if (!($changes instanceof CompanyData)) {
            $changes = CompanyData::from($changes);
        }

        $editAddress = new EditAddress();

        $company->update($changes->except('address', 'correspondenceAddress')->toArray());
        $editAddress->handle($company->address, $changes->address);
        $editAddress->handle($company->correspondenceAddress, $changes->correspondenceAddress);

        return $company;
    }

}
