<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(LazilyRefreshDatabase::class);

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

    livewire('users.create-user')
        ->set('user.name', $user['name'])
        ->set('user.email', $user['email'])
        ->set('user.password', $user['password'])
        ->call('submit')
        ->assertRedirect(route('users.index'));

    assertDatabaseHas('users', $user);
});

it('doesn\'t allow user to create user with incorrect data', function () {
    actingAs(User::factory()->create());

    $user = [
        'name' => 'John Doe',
        'email' => 'wrongemail',
        'password' => '1',
    ];

    livewire('users.create-user')
        ->set('user.name', $user['name'])
        ->set('user.email', $user['email'])
        ->set('user.password', $user['password'])
        ->call('submit')
        ->assertHasErrors(['email', 'password']);

    assertDatabaseMissing('users', $user);
});
