<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $companies = Company::paginate($this->perPage);

        return view('livewire.companies.table', [
            'companies' => $companies,
        ]);
    }
}
