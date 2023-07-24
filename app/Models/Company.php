<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function address(): belongsTo
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function correspondenceAddress(): belongsTo
    {
        return $this->belongsTo(Address::class, 'correspondence_address_id');
    }
}
