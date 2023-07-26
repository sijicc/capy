<?php

namespace App\Livewire\Users;

use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class CreateUser extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $user = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->suffixAction(
                        Action::make('generate')
                            ->icon('heroicon-m-shield-exclamation')
                            ->action(fn(Set $set) => $set('password', Str::password()))
                            ->tooltip(__('Generate a safe password')),
                    ),
            ])
            ->statePath('user');
    }

    public function submit(\App\Actions\CreateUser $createUser): RedirectResponse|Redirector
    {
        $createUser->handle($this->user);

        return redirect()->route('users.index');
    }

    public function render(): View
    {
        return view('livewire.users.create-user');
    }
}
