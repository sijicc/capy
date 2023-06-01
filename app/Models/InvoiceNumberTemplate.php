<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvoiceNumberTemplate extends Model
{
    protected $guarded = ['id'];

    public const CURRENT_YEAR = '@CURRENT_YEAR@';

    public const CURRENT_MONTH = '@CURRENT_MONTH@';

    public const CURRENT_DAY = '@CURRENT_DAY@';

    public const CURRENT_HOUR = '@CURRENT_HOUR@';

    public const NEXT_NUMBER = '@NEXT_NUMBER@';

    public const NEXT_NUMBER_WITH_LEADING_ZEROS = '@NEXT_NUMBER_WITH_LEADING_ZEROS@';

    public const INVOICE_TYPE = '@INVOICE_TYPE@';

    public function getNextNumberAttribute(): int
    {
        return $this->invoices()->count() + 1;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'invoice_number_template_id');
    }
}
