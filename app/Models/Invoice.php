<?php

namespace App\Models;

use Cknow\Money\Casts\MoneyDecimalCast;
use Cknow\Money\Tests\Database\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'issue_date' => 'datetime',
        'sale_date' => 'datetime',
        'due_date' => 'datetime',
        'payment_date' => 'datetime',

        'net_total' => MoneyDecimalCast::class.':currency',
        'tax_total' => MoneyDecimalCast::class.':currency',
        'gross_total' => MoneyDecimalCast::class.':currency',
        'advance_total' => MoneyDecimalCast::class.':currency',
    ];

    public function exchangeRate(): Attribute
    {
        return Attribute::make(
            fn ($value) => $value / 100,
            fn ($value) => $value * 100,
        );
    }

    public function customerable(): MorphTo
    {
        return $this->morphTo();
    }

    public function receiverable(): MorphTo
    {
        return $this->morphTo();
    }

    public function vendorable(): MorphTo
    {
        return $this->morphTo();
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function final(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function customerCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function receiverCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function vendorCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function numberTemplate(): BelongsTo
    {
        return $this->belongsTo(InvoiceNumberTemplate::class);
    }
}
