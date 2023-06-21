<x-card class="min-h-secreen" footer-class="flex justify-end">
    <x-slot:header>
        <div class="flex justify-between">
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    {{ __('Create Company') }}
                </h3>
                <div class="mt-1 max-w-2xl text-sm text-gray-500">
                    <p>
                        {{ __('Here you can create a new company.') }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot:header>

    <form method="post" wire:submit.prevent="store">
        @csrf
        <div>
            <div class="my-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
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

            <div class="border-t border-gray-200"></div>
            <div class="my-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    {{ __('Address') }}
                </h3>
                <div class="mt-1 max-w-2xl text-sm text-gray-500">
                    <p>
                        {{ __('Here you can add address for this company.') }}
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <x-forms.label for="country_id" :value="__('Country')"/>
                <x-forms.select name="country_id" type="text" wire:model.defer="company.address.country_id"
                                :options="$this->countries()"/>
            </div>

            <div class="mb-6">
                <x-forms.label for="administrative_area" :value="__('Administrative area')"/>
                <x-forms.info>
                    {{ __('For example: voivodeship, state, province, etc.') }}
                </x-forms.info>
                <x-forms.input name="administrative_area" type="text"
                               wire:model.defer="company.address.administrative_area"/>
            </div>

            <div class="mb-6">
                <x-forms.label for="city" :value="__('City')"/>
                <x-forms.input name="city" type="text" wire:model.defer="company.address.city"/>
            </div>

            <div class="mb-6">
                <x-forms.label for="zip" :value="__('Postal code')"/>
                <x-forms.input name="zip" type="text" wire:model.defer="company.address.zip"/>
            </div>

            <div class="mb-6">
                <x-forms.label for="street" :value="__('Street')"/>
                <x-forms.input name="street" type="text" wire:model.defer="company.address.street"/>
            </div>

            <div class="border-t border-gray-200"></div>
            <div class="my-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    {{ __('Correspondence address') }}
                </h3>
                <div class="mt-1 max-w-2xl text-sm text-gray-500">
                    <p>
                        {{ __('Here you can add correspondence address for this company.') }}
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <x-forms.label for="country_id" :value="__('Country')"/>
                <x-forms.select name="country_id" type="text"
                                wire:model.defer="company.correspondenceAddress.country_id"
                                :options="$this->countries()"/>
            </div>

            <div class="mb-6">
                <x-forms.label for="administrative_area" :value="__('Administrative area')"/>
                <x-forms.info>
                    {{ __('For example: voivodeship, state, province, etc.') }}
                </x-forms.info>
                <x-forms.input name="administrative_area" type="text"
                               wire:model.defer="company.correspondenceAddress.administrative_area"/>
            </div>

            <div class="mb-6">
                <x-forms.label for="city" :value="__('City')"/>
                <x-forms.input name="city" type="text" wire:model.defer="company.correspondenceAddress.city"/>
            </div>

            <div class="mb-6">
                <x-forms.label for="zip" :value="__('Postal code')"/>
                <x-forms.input name="zip" type="text" wire:model.defer="company.correspondenceAddress.zip"/>
            </div>

            <div class="mb-6">
                <x-forms.label for="street" :value="__('Street')"/>
                <x-forms.input name="street" type="text" wire:model.defer="company.correspondenceAddress.street"/>
            </div>

        </div>

        <div>
            <x-button color="danger" :href="route('companies.index')" class="mr-3">
                {{ __('Cancel') }}
            </x-button>
            <x-button color="submit">
                {{ __('Create') }}
            </x-button>
        </div>
    </form>
</x-card>
