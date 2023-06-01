<?php

namespace App\Enums;

enum InvoiceStatus
{
    case DRAFT;
    case CONFIRMED;
    case SENT;
    case PAID;
    case OVERDUE;
    case CANCELLED;

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
}
