<?php

namespace App\Http\Livewire\Users;

use App\Actions\CreateUser;
use App\Data\UserData;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Redirector;
use Str;

class Create extends Component
{
    public array $user;

    public function mount(): void
    {
        $this->user = UserData::empty();
    }

    public function store(CreateUser $createUser): RedirectResponse|Redirector
    {
        $createUser->handle($this->user);

        return redirect()->route('users.index');
    }

    public function generateSafePassword(): void
    {
        $this->user['password'] = Str::password(32);
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.users.create');
    }
}
