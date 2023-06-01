<?php

namespace App\Http\Livewire\Invoices;

use App\Actions\CreateInvoice;
use App\Data\InvoiceData;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
}
