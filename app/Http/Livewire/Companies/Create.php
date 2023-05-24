<?php

namespace App\Http\Livewire\Companies;

use App\Actions\CreateCompany;
use App\Data\CompanyData;
use App\Models\Country;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Create extends Component
{
    public array $company;

    public function mount(): void
    {
        $this->company = CompanyData::empty();
    }

    public function countries(): Collection
    {
        return Country::pluck('name', 'id');
    }

    public function store(CreateCompany $createCompany)
    {
        $createCompany->handle($this->company);

        return redirect()->route('companies.index');
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.companies.create');
    }
}
