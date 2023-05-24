<?php

namespace App\Actions;

use App\Data\AddressData;
use App\Models\Address;

class CreateAddress
{
    public function handle(array|AddressData|null $address = []): Address
    {
        AddressData::validate($address);

        if (!($address instanceof AddressData)) {
            $address = AddressData::from($address ?? []);
        }

        return Address::create($address->toArray());
    }
}
