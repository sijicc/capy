<x-card class="min-h-screen" x-data="{invoice: @entangle('invoice')}">
    <x-slot:header>
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    {{ __('Create Invoice') }}
                </h3>
                <div class="mt-1 max-w-2xl text-sm text-gray-500">
                    <p>
                        {{ __('Here you can create a new invoice.') }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot:header>
    <form method="post" wire:submit.prevent="store">
        @csrf
        <div class="flex justify-content-between">
            <div class="mb-6">
                <x-forms.label for="invoice.number" class="required" :value="__('Number')"/>
                <x-forms.info class="mb-2">
                    {{ __('The number of the invoice. It will be generated automatically. ') }}
                </x-forms.info>
                <x-forms.input name="invoice.number" type="text" wire:model.defer="invoice.number" disabled/>
            </div>
            <div class="mb-6 flex flex-col items-bottom align-bottom">
                <x-forms.label for="invoice.invoice_number_template_id" class="required"
                               :value="__('Number template')"/>
                <x-forms.select
                    name="invoice.invoice_number_template_id"
                    wire:model.lazy="invoice.invoice_number_template_id"
                    :options="$this->getInvoiceNumberTemplates()"
                    required
                />
            </div>
        </div>
        <div class="mb-6">
            <x-forms.label for="invoice.type" class="required" :value="__('Type')"/>
            <x-forms.select
                name="invoice.type"
                wire:model.lazy="invoice.type"
                :options="\App\Enums\InvoiceType::asCollection()"
                required
            />
    </form>
</x-card>
