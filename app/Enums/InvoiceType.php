<?php

namespace App\Enums;

enum InvoiceType
{
    case INVOICE;
    case PROFORMA;
    case CORRECTION;
    case ADVANCE;
    case FINAL;

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
}
