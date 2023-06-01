<?php

namespace App\Actions;

use App\Data\InvoiceData;
use App\Models\Invoice;

class CreateInvoice
{
    public function handle(array $invoice): Invoice
    {
        $invoice = InvoiceData::validateAndCreate($invoice);

        return Invoice::create($invoice->toArray());
    }
}
