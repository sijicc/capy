<?php

namespace App\Http\Controllers;

use App\Models\Company;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Company::class, 'company');
    }

    public function index()
    {
        return view('companies.index');
    }

    public function create()
    {
        return view('companies.create');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', [
            'company' => $company,
        ]);
    }

    public function show(Company $company)
    {
        return view('companies.show', [
            'company' => $company,
        ]);
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with('success', __('Company deleted successfully'));
    }
}
