<?php

namespace App\Http\Livewire\Users;

use App\Actions\EditUser;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Edit extends Component
{
    public array $user;

    public function mount(): void
    {
        $this->user['id'] = Crypt::encryptString($this->user['id']);
        $this->user['password'] = null;
    }

    public function update(EditUser $editUser)
    {
        $user = $editUser->handle(
            user: User::firstWhere('id', Crypt::decryptString($this->user['id'])),
            changes: $this->user
        );

        return redirect()->route('users.show', $user);
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.users.edit');
    }
}
