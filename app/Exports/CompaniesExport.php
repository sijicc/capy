<?php

namespace App\Exports;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompaniesExport implements FromCollection
{
    protected Collection $companies;

    public function __construct(Collection $companies)
    {
        $this->companies = $companies;
    }

    public function collection(): Collection|\Illuminate\Support\Collection
    {
        return $this->companies;
    }
}
