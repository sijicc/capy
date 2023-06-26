<?php

namespace App\Http\Livewire\Invoices;

use App\Actions\CreateInvoice;
use App\Actions\GenerateInvoiceNumberFromTemplate;
use App\Data\InvoiceData;
use App\Enums\InvoiceStatus;
use App\Enums\InvoiceType;
use App\Models\Company;
use App\Models\InvoiceNumberTemplate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Redirector;

class Create extends Component
{
    public array $invoice = [
        'number' => null,
        'invoice_number_template_id' => null,
        'type' => InvoiceType::INVOICE,
        'status' => InvoiceStatus::DRAFT,

        'net_total' => 0,
        'tax_total' => 0,
        'gross_total' => 0,

        'currency' => 'PLN',
        'exchange_rate' => 100,

        'advance_total' => null,
        'final_id' => null,

        'issue_date' => null,
        'sale_date' => null,
        'due_date' => null,
        'payment_date' => null,

        'customerable_id' => null,
        'customerable_type' => null,
        'customer_name' => null,
        'customer_address' => null,
        'customer_zip' => null,
        'customer_city' => null,
        'customer_country_id' => null,
        'customer_nip' => null,
        'customer_email' => null,
        'customer_phone' => null,

        'receiverable_id' => null,
        'receiverable_type' => null,
        'receiver_name' => null,
        'receiver_address' => null,
        'receiver_zip' => null,
        'receiver_city' => null,
        'receiver_country_id' => null,
        'receiver_nip' => null,
        'receiver_email' => null,
        'receiver_phone' => null,

        'vendorable_id' => null,
        'vendorable_type' => null,
        'vendor_name' => null,
        'vendor_address' => null,
        'vendor_zip' => null,
        'vendor_city' => null,
        'vendor_country_id' => null,
        'vendor_nip' => null,
        'vendor_email' => null,
        'vendor_phone' => null,

        'items' => [],
        'notes' => null,
    ];

    public function store(CreateInvoice $createInvoice): RedirectResponse|Redirector
    {
        $this->validate();

        $createInvoice->handle($this->invoice);

        return redirect()->route('invoices.index');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.invoices.create');
    }

    public function updatedInvoiceinvoiceNumberTemplateId(): void
    {
        $invoiceNumberTemplate = InvoiceNumberTemplate::find($this->invoice['invoice_number_template_id']);

        $this->invoice['number'] = (new GenerateInvoiceNumberFromTemplate())->handle(
            invoiceNumberTemplate: $invoiceNumberTemplate,
            type: $this->invoice['type'] ?? InvoiceType::INVOICE,
            date: $this->invoice['issue_date'] ?? null,
        );
    }

    public function getInvoiceNumberTemplates(): array|Collection
    {
        $invoiceNumberTemplates = InvoiceNumberTemplate::pluck('name', 'id');

        if ($this->invoice['customerable_id'] && $this->invoice['customerable_type'] === Company::class) {
            $invoiceNumberTemplates = $invoiceNumberTemplates->where('company_id', $this->invoice['customerable_id']);
        }

        return $invoiceNumberTemplates->all();
    }
}
