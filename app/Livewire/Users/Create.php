<?php

namespace App\Livewire\Users;

use App\Actions\CreateUser;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Str;

class Create extends Component
{
    public array $user = [
        'name' => null,
        'email' => null,
        'password' => null,
    ];

    public function store(CreateUser $createUser): RedirectResponse|Redirector
    {
        $createUser->handle($this->user);

        return redirect()->route('users.index');
    }

    public function generateSafePassword(): void
    {
        $this->user['password'] = Str::password();
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.users.create');
    }
}
