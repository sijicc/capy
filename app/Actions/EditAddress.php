<?php

namespace App\Actions;

use App\Data\AddressData;
use App\Models\Address;

class EditAddress
{
    public function handle(Address $address, array|AddressData|null $changes = []): Address
    {
        $changes = AddressData::validate($changes);

        $address->update($changes);

        return $address;
    }

}
