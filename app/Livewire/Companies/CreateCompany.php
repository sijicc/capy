<?php

namespace App\Livewire\Companies;

use App\Models\Country;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class CreateCompany extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $company = [];

    public function mount(): void
    {
        $this->form->fill();
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
                    TextInput::make('address.postal_code'),
                    TextInput::make('address.street'),
                ]),
                Fieldset::make(__('Correspondence address'))->schema([
                    Select::make('correspondence_address.country_id')
                        ->options(Country::all()->pluck('name', 'id'))
                        ->searchable(),
                    TextInput::make('correspondence_address.administrative_area'),
                    TextInput::make('correspondence_address.city'),
                    TextInput::make('correspondence_address.postal_code'),
                    TextInput::make('correspondence_address.street'),
                ]),
            ])
            ->statePath('company');
    }

    public function submit(\App\Actions\CreateCompany $createCompany): RedirectResponse|Redirector
    {
        $createCompany->handle($this->company);

        return redirect()->route('companies.index');
    }

    public function render(): View
    {
        return view('livewire.companies.create-company');
    }

    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title($exception->getMessage())
            ->danger()
            ->send();
    }
}
