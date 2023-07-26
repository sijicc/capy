<x-card class="min-h-screen" footer-class="flex justify-end">
    @if (isset($heading) || isset($subheading))
        <x-slot name="header">
            <div class="flex justify-between">
                <div>
                    @if (isset($heading))
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            {{ $heading }}
                        </h3>
                    @endif

                    @if (isset($subheading))
                        <div class="mt-1 max-w-2xl text-sm text-gray-500">
                            <p>
                                {{ $subheading }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </x-slot>
    @endif

    <form wire:submit="submit">
        {{ $slot }}

        <div class="mt-3">
            <x-button color="danger" :href="$cancelButtonUrl" class="mr-3">
                {{ __("Cancel") }}
            </x-button>
            <x-button type="submit" color="primary">
                {{ $submitButtonText ?? __("Save changes") }}
            </x-button>
        </div>
    </form>
</x-card>
