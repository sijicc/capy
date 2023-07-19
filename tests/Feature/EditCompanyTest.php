<?php

use App\Http\Livewire\Companies\Edit;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(LazilyRefreshDatabase::class);

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

    $changes = [
        'name' => 'Biedronka',
        'nip' => '7791011327',
        'regon' => '630303023',
    ];

    livewire(Edit::class, ['company' => $company->getAttributes()])
        ->set('company.name', $changes['name'])
        ->set('company.nip', $changes['nip'])
        ->set('company.regon', $changes['regon'])
        ->call('update')
        ->assertRedirect(route('companies.show', $company));

    $this->assertDatabaseHas('companies', $changes);
    $this->assertDatabaseMissing('companies', $company->getAttributes());
});

it('doesn\'t allow user to edit company with incorrect data', function () {
    actingAs(User::factory()->create());

    $company = Company::factory()->create();

    $changes = [
        'name' => 'Biedronka',
        'nip' => '0000000000',
        'regon' => '123456789',
    ];

    livewire(Edit::class, ['company' => $company->getAttributes()])
        ->set('company.name', $changes['name'])
        ->set('company.nip', $changes['nip'])
        ->set('company.regon', $changes['regon'])
        ->call('update')
        ->assertHasErrors(['nip', 'regon']);

    $this->assertDatabaseHas('companies', $company->getAttributes());
    $this->assertDatabaseMissing('companies', $changes);
});
