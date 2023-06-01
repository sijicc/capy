<?php

namespace App\Actions;

use App\Models\InvoiceNumberTemplate;
use Carbon\Carbon;

class GenerateInvoiceNumberFromTemplate
{
    public function handle(
        InvoiceNumberTemplate $invoiceNumberTemplate,
        string $type,
        int $padLength = 4,
        Carbon $date = null
    ): string {
        $invoiceNumber = $invoiceNumberTemplate->template;

        if (! $date) {
            $date = now();
        }

        $invoiceNumber = str_replace(InvoiceNumberTemplate::CURRENT_YEAR, $date->format('Y'), $invoiceNumber);
        $invoiceNumber = str_replace(InvoiceNumberTemplate::CURRENT_MONTH, $date->format('m'), $invoiceNumber);
        $invoiceNumber = str_replace(InvoiceNumberTemplate::CURRENT_DAY, $date->format('d'), $invoiceNumber);
        $invoiceNumber = str_replace(InvoiceNumberTemplate::CURRENT_HOUR, $date->format('H'), $invoiceNumber);

        $invoiceNumber = str_replace(
            search: InvoiceNumberTemplate::NEXT_NUMBER,
            replace: $invoiceNumberTemplate->next_number,
            subject: $invoiceNumber
        );
        $invoiceNumber = str_replace(
            search: InvoiceNumberTemplate::NEXT_NUMBER_WITH_LEADING_ZEROS,
            replace: str_pad(
                string: $invoiceNumberTemplate->next_number,
                length: $padLength,
                pad_string: '0',
                pad_type: STR_PAD_LEFT
            ),
            subject: $invoiceNumber
        );
        $invoiceNumber = str_replace(
            search: InvoiceNumberTemplate::INVOICE_TYPE,
            replace: $type,
            subject: $invoiceNumber
        );

        return $invoiceNumber;
    }
}
