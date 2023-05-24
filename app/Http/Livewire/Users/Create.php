<?php

namespace App\Http\Livewire\Users;

use App\Actions\CreateUser;
use App\Data\UserData;
use Livewire\Component;
use Str;

class Create extends Component
{
    public array $user;

    public function mount(): void
    {
        $this->user = UserData::empty();
    }

    public function store(CreateUser $createUser)
    {
        $createUser->handle($this->user);

        return redirect()->route('users.index');
    }

    public function generateSafePassword(): void
    {
        $this->user['password'] = Str::password(32);
    }

    public function render()
    {
        return view('livewire.users.create');
    }
}
