<?php

namespace App\Actions;

use App\Http\Requests\AddresRequest;
use App\Models\Address;
use Validator;

readonly class EditAddress
{
    public function __construct(
        private AddresRequest $addresRequest = new AddresRequest(),
    )
    {
    }

    public function handle(Address $address, array $changes = []): Address
    {
        $validated = Validator::make($changes, $this->addresRequest->rules())->validate();

        $address->update($validated);

        return $address;
    }
}
