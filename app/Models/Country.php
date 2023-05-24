<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // We will use the country code as the ID
    public $incrementing = false;

    public $timestamps = false;

    public function asSelectOptions(): array
    {
        return $this->all()->pluck('name', 'id')->toArray();
    }
}
