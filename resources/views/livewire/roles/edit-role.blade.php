<x-card class="min-h-screen" footer-class="flex justify-end">
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    {{ __("Edit role") }}
                </h3>
                <div class="mt-1 max-w-2xl text-sm text-gray-500">
                    <p>
                        {{ __("Here you can edit a role.") }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <div class="mt-3">
            <x-button color="danger" :href="route('roles.index')" class="mr-3">
                {{ __("Cancel") }}
            </x-button>
            <x-button type="submit" color="primary">
                {{ __("Save changes") }}
            </x-button>
        </div>
    </form>
</x-card>
