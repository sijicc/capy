<?php

use App\Http\Livewire\Roles\CreateRole;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

uses(LazilyRefreshDatabase::class);

it('doesn\'t allow guest to create role', function () {
    get(route('roles.create'))
        ->assertRedirect(route('login'));
});

it('allows user to create role with name', function () {
    $role = [
        'name' => fake()->word(),
    ];

    livewire(CreateRole::class)
        ->set('name', $role['name'])
        ->call('submit')
        ->assertRedirect(route('roles.index'));

    $this->assertDatabaseHas('roles', $role);
});

it('doesn\'t allow user to create role without name', function () {
    $role = [
        'name' => '',
    ];

    livewire(CreateRole::class)
        ->set('name', $role['name'])
        ->call('submit')
        ->assertHasErrors(['name']);

    $this->assertDatabaseMissing('roles', $role);
});

it('doesn\'t allow user to create role with name that already exists', function () {
    seed(RoleSeeder::class);

    $role = [
        'name' => 'Admin',
        'description' => fake()->sentence(),
    ];

    livewire(CreateRole::class)
        ->set('name', $role['name'])
        ->set('description', $role['description'])
        ->call('submit')
        ->assertHasErrors(['name']);

    $this->assertDatabaseMissing('roles', $role);
});

it('doesn\'t allow user to create role with too long name', function () {
    $role = [
        'name' => str_repeat('a', 256),
    ];

    livewire(CreateRole::class)
        ->set('name', $role['name'])
        ->call('submit')
        ->assertHasErrors(['name']);

    $this->assertDatabaseMissing('roles', $role);
});

it('doesn\'t allow user to create role with too long description', function () {
    $role = [
        'name' => fake()->word(),
        'description' => str_repeat('a', 256),
    ];

    livewire(CreateRole::class)
        ->set('name', $role['name'])
        ->set('description', $role['description'])
        ->call('submit')
        ->assertHasErrors(['description']);

    $this->assertDatabaseMissing('roles', $role);
});
