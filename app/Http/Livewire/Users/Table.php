<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public int $perPage = 10;

    public function confirmDelete(int $id): void
    {
        $this->dispatchBrowserEvent('confirm-delete', ['id' => $id]);
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $users = User::paginate($this->perPage);

        return view('livewire.users.table', [
            'users' => $users,
        ]);
    }
}
