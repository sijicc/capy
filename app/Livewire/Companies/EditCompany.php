<?php

namespace App\Livewire\Companies;

use App\Models\Address;
use App\Models\Company;
use App\Models\Country;
use Crypt;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class EditCompany extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $company = [];

    public function mount(): void
    {
        $this->company['address'] = Address::firstWhere('id', $this->company['address_id'])->getAttributes();
        $this->company['correspondence_address'] = Address::firstWhere('id', $this->company['correspondence_address_id'])->getAttributes();
        $this->company['id'] = Crypt::encryptString($this->company['id']);
        $this->form->fill($this->company);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make(__('Basic info'))->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('nip')
                        ->required(),
                    TextInput::make('regon')
                        ->required(),
                    TextInput::make('krs'),
                    TextInput::make('email'),
                    TextInput::make('phone'),
                ]),
                Fieldset::make(__('Address'))->schema([
                    Select::make('address.country_id')
                        ->options(Country::all()->pluck('name', 'id'))
                        ->searchable(),
                    TextInput::make('address.administrative_area'),
                    TextInput::make('address.city'),
                    TextInput::make('address.zip'),
                    TextInput::make('address.street'),
                ]),
                Fieldset::make(__('Correspondence address'))->schema([
                    Select::make('correspondence_address.country_id')
                        ->options(Country::all()->pluck('name', 'id'))
                        ->searchable(),
                    TextInput::make('correspondence_address.administrative_area'),
                    TextInput::make('correspondence_address.city'),
                    TextInput::make('correspondence_address.zip'),
                    TextInput::make('correspondence_address.street'),
                ]),
            ])
            ->statePath('company');
    }

    public function submit(\App\Actions\EditCompany $editCompany): RedirectResponse|Redirector
    {
        $company = $editCompany->handle(
            company: Company::firstWhere('id', Crypt::decryptString($this->company['id'])),
            changes: $this->company
        );

        return redirect()->route('companies.show', $company);
    }

    public function render(): View
    {
        return view('livewire.companies.edit-company');
    }
}
