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
    public array $invoice;

    public function mount(): void
    {
        $this->invoice = InvoiceData::empty();
    }

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
