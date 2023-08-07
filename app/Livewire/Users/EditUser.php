<?php

namespace App\Livewire\Users;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class EditUser extends Component implements HasForms
{
    use InteractsWithForms;

    public array $user = [];

    public function mount(): void
    {
        $this->user['id'] = Crypt::encryptString($this->user['id']);
        $this->user['password'] = null;
        $this->form->fill($this->user);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()->maxLength(255),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255)
                    ->unique('users', 'email', User::firstWhere('id', Crypt::decryptString($this->user['id']))),
                TextInput::make('password')
                    ->password()
                    ->autocomplete('new-password')
                    ->helperText('Leave blank to keep the same password.')
                    ->nullable()
                    ->rule(Password::min(8)->letters()->mixedCase()->numbers()),
            ])
            ->statePath('user');
    }

    public function submit(\App\Actions\EditUser $editUser): RedirectResponse|Redirector
    {
        $this->validate();

        $user = $editUser->handle(
            user: User::firstWhere('id', Crypt::decryptString($this->user['id'])),
            changes: $this->user
        );

        return redirect()->route('users.show', $user);
    }

    // TODO: Tests fail if this is removed? I should ask somebody on discord
    public function render(): View
    {
        return view('livewire.users.edit-user');
    }
}
