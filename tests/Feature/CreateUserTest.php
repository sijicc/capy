<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();
});

it('doesn\'t allow guest to create user', function () {
    get(route('companies.create'))
        ->assertRedirect(route('login'));
});

it('allows user to create user with correct data', function () {
    actingAs(User::factory()->create());

    $user = [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'Password123!',
    ];

    livewire('users.create')
        ->set('user.name', $user['name'])
        ->set('user.email', $user['email'])
        ->set('user.password', $user['password'])
        ->call('store')
        ->assertRedirect(route('users.index'));

    assertDatabaseHas('users', $user);
});

it('allows user to generate safe password', function () {
    actingAs(User::factory()->create());

    livewire('users.create')
        ->call('generateSafePassword')
        ->assertNotSet('user.password', null);
});

it('doesn\'t allow user to create user with incorrect data', function () {
    actingAs(User::factory()->create());

    $user = [
        'name' => 'John Doe',
        'email' => 'wrongemail',
        'password' => '1',
    ];

    livewire('users.create')
        ->set('user.name', $user['name'])
        ->set('user.email', $user['email'])
        ->set('user.password', $user['password'])
        ->call('store')
        ->assertHasErrors(['email', 'password']);

    assertDatabaseMissing('users', $user);
});
