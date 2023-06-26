<?php

use App\Http\Livewire\Companies\Edit;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
});

it('doesn\'t allow guest to edit company', function () {
    get(route('companies.edit', Company::factory()->create()))
        ->assertRedirect(route('login'));
});

it('allows user to edit company with correct data', function () {
    actingAs(User::factory()->create());

    $company = Company::factory()->create();

    livewire(Edit::class, ['company' => $company->getAttributes()])
        ->set('company.name', 'Biedronka')
        ->set('company.nip', '7791011327')
        ->set('company.regon', '630303023')
        ->call('update')
        ->assertRedirect(route('companies.show', $company));

    $this->assertDatabaseHas('companies', [
        'name' => 'Biedronka',
        'nip' => '7791011327',
        'regon' => '630303023',
    ]);

    $this->assertDatabaseMissing('companies', [
        'name' => $company->name,
        'nip' => $company->nip,
        'regon' => $company->regon,
    ]);
});

it('doesn\'t allow user to edit company with incorrect data', function () {
    actingAs(User::factory()->create());

    $company = Company::factory()->create();

    livewire(Edit::class, ['company' => $company->getAttributes()])
        ->set('company.name', 'Biedronka')
        ->set('company.nip', '0000000000')
        ->set('company.regon', '123456789')
        ->call('update')
        ->assertHasErrors(['nip', 'regon']);

    $this->assertDatabaseHas('companies', [
        'name' => $company->name,
        'nip' => $company->nip,
        'regon' => $company->regon,
    ]);

    $this->assertDatabaseMissing('companies', [
        'name' => 'Biedronka',
        'nip' => '0000000000',
        'regon' => '123456789',
    ]);
});
