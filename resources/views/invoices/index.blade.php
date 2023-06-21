<x-auth-layout :title="[['name' => __('Invoices'), 'route' => route('invoices.index')]]">
    <x-card class="h-screen">
        <x-slot:header>
            <div class="flex justify-between">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        {{ __('Invoices') }}
                    </h3>
                    <div class="mt-1 max-w-2xl text-sm text-gray-500">
                        <p>
                            {{ __('Here you can manage your invoices.') }}
                        </p>
                    </div>
                </div>

                <div>
                    <x-button :href="route('invoices.create')">
                        {{ __('Create') }}
                    </x-button>
                </div>
            </div>
        </x-slot:header>
        <livewire:invoices.table/>
    </x-card>
</x-auth-layout>
