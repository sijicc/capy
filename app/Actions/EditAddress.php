<?php

namespace App\Actions;

use App\Models\Address;
use Validator;

readonly class EditAddress
{
    public function handle(Address $address, array $changes = []): Address
    {
        $validated = $this->validate($changes);

        $address->update($this->validate($changes));

        return $address;
    }

    protected function validate(array $changes): array
    {
        return Validator::make($changes, [
            'country_id' => ['nullable', 'integer', 'exists:countries,id'],
            'administrative_area' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'zip' => ['nullable', 'string', 'max:255'],
            'street' => ['nullable', 'string', 'max:255'],
        ])->validate();
    }
}
