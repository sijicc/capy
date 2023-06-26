<?php

namespace App\Actions;

use App\Models\Address;
use Validator;

readonly class CreateAddress
{
    public function handle(array $address): Address
    {
        $validated = $this->validate($address);

        return Address::create($validated);
    }

    protected function validate(array $address): array
    {
        return Validator::make($address, [
            'country_id' => ['nullable', 'integer', 'exists:countries,id'],
            'administrative_area' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'zip' => ['nullable', 'string', 'max:255'],
            'street' => ['nullable', 'string', 'max:255'],
        ])->validate();
    }
}
