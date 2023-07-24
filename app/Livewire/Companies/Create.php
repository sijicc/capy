<?php

namespace App\Livewire\Companies;

use App\Actions\CreateCompany;
use App\Models\Country;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Create extends Component
{
    public array $company = [
        'name' => null,
        'nip' => null,
        'regon' => null,
        'krs' => null,
        'email' => null,
        'phone' => null,
        'address' => [
            'country_id' => null,
            'administrative_area' => null,
            'city' => null,
            'postal_code' => null,
            'street' => null,
        ],
        'correspondence_address' => [
            'country_id' => null,
            'administrative_area' => null,
            'city' => null,
            'postal_code' => null,
            'street' => null,
        ],
    ];

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
