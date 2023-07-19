<?php

namespace App\Actions;

use App\Models\Invoice;
use Validator;

readonly class CreateInvoice
{
    public function __construct(
        protected CreateItem $createItem = new CreateItem(),
    ) {
    }

    public function handle(array $invoice): Invoice
    {
        $validated = $this->validate($invoice);

        foreach ($invoice['positions'] as $position) {
            $position['invoice_id'] = $invoice['id'];
            $this->createItem->handle($position);
        }

        return Invoice::create($validated);
    }

    protected function validate(array $invoice): array
    {
        return Validator::make($invoice, [
            // TODO: add validation rules
        ])->validate();
    }
}
