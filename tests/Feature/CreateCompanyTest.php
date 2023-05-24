<?php

use App\Data\CompanyData;
use App\Http\Livewire\Companies\Create;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{get, actingAs};
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

it('doesn\'t allow guest to create company', function () {
    get(route('companies.create'))
        ->assertRedirect(route('login'));
});

it('allows user to create company with correct data', function () {
    actingAs(User::factory()->create());

    $company = CompanyData::empty([
        'name' => 'Biedronka',
        'nip' => '7791011327',
        'regon' => '630303023',
    ]);

    livewire(Create::class)
        ->set('company', $company)
        ->call('store')
        ->assertRedirect(route('companies.index'));

    $this->assertDatabaseHas('companies', array_filter($company, fn ($key) => in_array($key, ['name', 'nip', 'regon']), ARRAY_FILTER_USE_KEY));
});

it('doesn\'t allow user to create company with incorrect data', function () {
    actingAs(User::factory()->create());

    $company = CompanyData::empty([
        'name' => 'Biedronka',
        'nip' => '0000000000',
        'regon' => '123456789',
    ]);

    livewire(Create::class)
        ->set('company', $company)
        ->call('store')
        ->assertHasErrors(['nip', 'regon']);

    $this->assertDatabaseMissing('companies', array_filter($company, fn ($key) => in_array($key, ['name', 'nip', 'regon']), ARRAY_FILTER_USE_KEY));
});
