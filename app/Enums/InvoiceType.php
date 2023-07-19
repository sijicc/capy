<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum InvoiceType: string
{
    case INVOICE = 'invoice';
    case PROFORMA = 'proforma';
    case CORRECTION = 'correction';
    case ADVANCE = 'advance';
    case FINAL = 'final';

    public function label(): string
    {
        return match ($this) {
            self::INVOICE => __('Invoice'),
            self::PROFORMA => __('Proforma invoice'),
            self::CORRECTION => __('Correction invoice'),
            self::ADVANCE => __('Advance invoice'),
            self::FINAL => __('Final invoice'),
        };
    }

    public static function asCollection(): Collection
    {
        return collect(self::cases())->mapWithKeys(fn (self $type) => [$type->value => $type->label()]);
    }
}
