<?php

use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Spatie\Permission\Models\Role;
use function Pest\Laravel\seed;
use function Pest\Livewire\livewire;

uses(LazilyRefreshDatabase::class);

it('doesn\'t allow guests to edit roles', function () {
    $role = Role::create(['name' => 'role', 'pretty_name' => 'Role']);

    $this->get(route('roles.edit', $role))
        ->assertRedirect(route('login'));
});

it('doesn\'t allow any user to edit admin role', function () {
    seed(RoleSeeder::class);
    $user = User::factory()->create();

    $adminRole = Role::firstWhere('name', 'admin');

    $this->actingAs($user)
        ->get(route('roles.edit', $adminRole))
        ->assertForbidden();

    $admin = User::factory()->create();
    $admin->assignRole($adminRole);

    $this->actingAs($admin)
        ->get(route('roles.edit', $adminRole))
        ->assertForbidden();
});

it('allows user to edit role', function () {
    $role = Role::create(['name' => 'role', 'pretty_name' => 'Role']);

    livewire('roles.edit-role', ['role' => $role])
        ->set('name', 'new name')
        ->call('submit')
        ->assertRedirect(route('roles.index'));
});

it('doesn\'t allow user to edit role to name that already exists', function () {
    seed(RoleSeeder::class);

    $role = Role::create(['name' => 'role']);
    $existingRole = Role::firstWhere('name', 'admin');

    livewire('roles.edit-role', ['role' => $role])
        ->set('name', $existingRole->name)
        ->call('submit')
        ->assertHasErrors(['name']);
});

it('doesn\'t allow user to edit role without name', function () {
    $role = Role::create(['name' => 'role']);

    livewire('roles.edit-role', ['role' => $role])
        ->set('name', '')
        ->call('submit')
        ->assertHasErrors(['name']);
});

it('doesn\'t allow user to edit role with too long name', function () {
    $role = Role::create(['name' => 'role']);

    livewire('roles.edit-role', ['role' => $role])
        ->set('name', str_repeat('a', 256))
        ->call('submit')
        ->assertHasErrors(['name']);
});

it('doesn\'t allow user to edit role with too long description', function () {
    $role = Role::create(['name' => 'role']);

    livewire('roles.edit-role', ['role' => $role])
        ->set('description', str_repeat('a', 256))
        ->call('submit')
        ->assertHasErrors(['description']);
});
