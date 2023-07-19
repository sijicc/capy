<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum InvoiceStatus: string
{
    case DRAFT = 'draft';
    case CONFIRMED = 'confirmed';
    case SENT = 'sent';
    case PAID = 'paid';
    case OVERDUE = 'overdue';
    case CANCELLED = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::DRAFT => __('Draft'),
            self::CONFIRMED => __('Confirmed'),
            self::SENT => __('Sent'),
            self::PAID => __('Paid'),
            self::OVERDUE => __('Overdue'),
            self::CANCELLED => __('Cancelled'),
        };
    }

    public static function asCollection(): Collection
    {
        return collect(self::cases())->mapWithKeys(fn (self $status) => [$status->value => $status->label()]);
    }
}
