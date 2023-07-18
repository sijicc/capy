<x-auth-layout>
    <x-card class="min-h-screen">
        <x-slot name="header">
            <div class="flex justify-between">
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        {{ __("Companies") }}
                    </h3>
                    <div class="mt-1 max-w-2xl text-sm text-gray-500">
                        <p>
                            {{ __("Here you can manage your companies.") }}
                        </p>
                    </div>
                </div>

                <div>
                    <x-button :href="route('companies.create')">
                        {{ __("Create") }}
                    </x-button>
                </div>
            </div>
        </x-slot>
        <livewire:companies.table />
    </x-card>
</x-auth-layout>
