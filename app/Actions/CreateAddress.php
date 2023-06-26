<?php

namespace App\Actions;

use App\Http\Requests\AddresRequest;
use App\Models\Address;
use Validator;

readonly class CreateAddress
{
    public function handle(array $address): Address
    {
        $validated = Validator::make($address, (new AddresRequest())->rules())->validate();

        return Address::create($validated);
    }
}
