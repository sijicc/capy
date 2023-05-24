<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'country_id',
        'administrative_area',
        'city',
        'zip',
        'street',
    ];
}
