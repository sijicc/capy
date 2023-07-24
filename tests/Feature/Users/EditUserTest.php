<?php

use App\Livewire\Users\Edit;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

uses(LazilyRefreshDatabase::class);

beforeEach(function () {
    $this->seed();
});

it('doesn\'t allow guest to edit user', function () {
    get(route('users.edit', User::factory()->create()))
        ->assertRedirect(route('login'));
});

it('allows user to edit user with correct data', function () {
    actingAs(User::factory()->create());

    $user = User::factory()->create();

    $changes = [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
    ];

    livewire(Edit::class, ['user' => $user->getAttributes()])
        ->set('user.name', $changes['name'])
        ->set('user.email', $changes['email'])
        ->set('user.password', 'Password123!')
        ->call('update')
        ->assertRedirect(route('users.show', $user));

    $this->assertDatabaseHas('users', $changes);
    $this->assertDatabaseMissing('users', $user->getAttributes());
});

it('doesn\'t change user password if it\'s not provided', function () {
    actingAs(User::factory()->create());

    $user = User::factory()->create([
        'password' => bcrypt('Password123!'),
    ]);

    $changes = [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
    ];

    livewire(Edit::class, ['user' => $user->getAttributes()])
        ->set('user.name', $changes['name'])
        ->set('user.email', $changes['email'])
        ->call('update')
        ->assertRedirect(route('users.show', $user));

    $this->assertDatabaseHas('users', $changes);

    $this->assertTrue(Hash::check('Password123!', $user->password));
});

it('doesn\'t allow user to edit user with incorrect data', function () {
    actingAs(User::factory()->create());

    $user = User::factory()->create();

    $changes = [
        'name' => 'John Doe',
        'email' => 'invalidemail',
    ];

    livewire(Edit::class, ['user' => $user->getAttributes()])
        ->set('user.name', $changes['name'])
        ->set('user.email', $changes['email'])
        ->set('user.password', 'invalidpassword')
        ->call('update')
        ->assertHasErrors(['email', 'password']);

    $this->assertDatabaseMissing('users', $changes);
    $this->assertDatabaseHas('users', $user->getAttributes());
});
