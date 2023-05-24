<x-card class="min-h-screen" footer-class="flex justify-end">
    <x-slot:header>
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ __('Create User') }}
                </h3>
                <div class="mt-1 max-w-2xl text-sm text-gray-500">
                    <p>
                        {{ __('Here you can create a new user.') }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot:header>

    <form method="post" wire:submit.prevent="store">
        @csrf
        <div>
            <div class="my-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ __('Company') }}
                </h3>
                <div class="mt-1 max-w-2xl text-sm text-gray-500">
                    <p>
                        {{ __('Here you can add company details.') }}
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <x-forms.label for="name" class="required" :value="__('Name')"/>
                <x-forms.input name="name" type="text" wire:model.defer="company.name" required/>
            </div>

            <div class="mb-6">
                <x-forms.label for="nip" class="required" :value="__('NIP')"/>
                <x-forms.input name="nip" type="text" wire:model.defer="company.nip" required/>
            </div>

            <div class="mb-6">
                <x-forms.label for="regon" class="required" :value="__('REGON')"/>
                <x-forms.input name="regon" type="text" wire:model.defer="company.regon" required/>
            </div>

            <div class="mb-6">
                <x-forms.label for="krs" :value="__('KRS')"/>
                <x-forms.input name="krs" type="text" wire:model.defer="company.krs"/>
            </div>
        </div>

        <div>
            <x-button type="danger" :href="route('users.index')" class="mr-3">
                {{ __('Cancel') }}
            </x-button>
            <x-button type="submit">
                {{ __('Create') }}
            </x-button>
        </div>
    </form>
</x-card>
