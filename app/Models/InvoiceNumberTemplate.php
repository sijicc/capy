<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InvoiceNumberTemplate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public const CURRENT_YEAR = '@CURRENT_YEAR@';

    public const CURRENT_MONTH = '@CURRENT_MONTH@';

    public const CURRENT_DAY = '@CURRENT_DAY@';

    public const CURRENT_HOUR = '@CURRENT_HOUR@';

    public const NEXT_NUMBER = '@NEXT_NUMBER@';

    public const NEXT_NUMBER_WITH_LEADING_ZEROS = '@NEXT_NUMBER_WITH_LEADING_ZEROS@';

    public const INVOICE_TYPE = '@INVOICE_TYPE@';

    public function getNextNumberAttribute(Carbon $date = null): int
    {
        if (! $date) {
            $date = now();
        }

        $query = $this->invoices();

        if (stripos($this->template, self::CURRENT_YEAR) !== false) {
            $query->whereBetween('created_at', [
                $date->startOfYear(),
                $date->endOfYear(),
            ]);
        }

        if (stripos($this->template, self::CURRENT_MONTH) !== false) {
            $query->whereBetween('created_at', [
                $date->startOfMonth(),
                $date->endOfMonth(),
            ]);
        }

        if (stripos($this->template, self::CURRENT_DAY) !== false) {
            $query->whereBetween('created_at', [
                $date->startOfDay(),
                $date->endOfDay(),
            ]);
        }

        if (stripos($this->template, self::CURRENT_HOUR) !== false) {
            $query->whereBetween('created_at', [
                $date->startOfHour(),
                $date->endOfHour(),
            ]);
        }

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
