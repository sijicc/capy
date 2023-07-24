<?php

namespace App\Livewire\Companies;

use App\Actions\EditCompany;
use App\Models\Address;
use App\Models\Company;
use App\Models\Country;
use Crypt;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Edit extends Component
{
    public array $company;

    public function mount(): void
    {
        $this->company['id'] = Crypt::encryptString($this->company['id']);
        $this->company['address'] = Address::firstWhere('id', $this->company['address_id'])
            ->getAttributes();
        $this->company['correspondenceAddress'] = Address::firstWhere('id', $this->company['correspondence_address_id'])
            ->getAttributes();
    }

    public function countries(): Collection
    {
        return Country::pluck('name', 'id');
    }

    public function update(EditCompany $editCompany)
    {
        $company = $editCompany->handle(
            company: Company::firstWhere('id', Crypt::decryptString($this->company['id'])),
            changes: $this->company
        );

        return redirect()->route('companies.show', $company);
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.companies.edit');
    }
}
