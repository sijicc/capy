<?php

namespace App\Traits;

use App\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasAddresses
{
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function addAddress($address)
    {
        return $this->addresses()->create($address);
    }

    public function removeAddress($address)
    {
        return $this->addresses()->delete($address);
    }

    public function updateAddress($address)
    {
        return $this->addresses()->update($address);
    }
}
