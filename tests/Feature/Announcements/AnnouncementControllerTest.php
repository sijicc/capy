<?php

use App\Models\User;
use Database\Seeders\AnnouncementSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use function Pest\Laravel\seed;

uses(RefreshDatabase::class);

it('doesn\'t allow guests to edit announcements', function () {
    $announcement = App\Models\Announcement::factory()->create();

    $this->get(route('announcements.edit', $announcement))
        ->assertRedirect(route('login'));
});

it('doesn\'t allow any user to edit published announcement', function () {
    $announcement = App\Models\Announcement::factory()->create();
    $announcement->publish();

    $user = App\Models\User::factory()->create();

    $this->actingAs($user)
        ->get(route('announcements.edit', $announcement))
        ->assertForbidden();

    seed(RoleSeeder::class);

    $admin = App\Models\User::factory()->create();
    $admin->assignRole(Role::firstWhere('name', 'admin'));

    $this->actingAs($admin)
        ->get(route('announcements.edit', $announcement))
        ->assertForbidden();
});

it('allows user with announcements:view permission to see existing announcement', function () {
    seed(PermissionSeeder::class);

    $announcement = App\Models\Announcement::factory()->published()->create();

    $user = User::factory()->create();
    $user->givePermissionTo('announcements:view');

    $this->actingAs($user)
        ->get(route('announcements.show', $announcement))
        ->assertOk();
});

it('prevents user from seeing not created announcement', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('announcements.show', 45))
        ->assertNotFound();
});

it('prevents user from seeing not published announcement', function () {
    seed(PermissionSeeder::class);

    $announcement = App\Models\Announcement::factory()->unpublished()->create();

    $user = User::factory()->create();
    $user->givePermissionTo('announcements:view');

    $this->actingAs($user)
        ->get(route('announcements.show', $announcement))
        ->assertForbidden();
});

it('allows creator or person with announcements:viewAny permission to see not published announcement', function () {
    seed(PermissionSeeder::class);

    $announcement = App\Models\Announcement::factory()->unpublished()->create();

    $user = User::factory()->create();
    $user->givePermissionTo('announcements:viewAny');

    $this->actingAs($user)
        ->get(route('announcements.show', $announcement))
        ->assertOk();

    $announcement->user->givePermissionTo('announcements:view');

    $this->actingAs($announcement->user)
        ->get(route('announcements.show', $announcement))
        ->assertOk();
});

it('allows user with announcements:create permission to create announcement', function () {
    seed(PermissionSeeder::class);

    $user = User::factory()->create();
    $user->givePermissionTo('announcements:create');

    $this->actingAs($user)
        ->get(route('announcements.create'))
        ->assertOk();
});

it('prevents user from creating announcement without announcements:create permission', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('announcements.create'))
        ->assertForbidden();
});

it('allows user with announcements:viewAny permission to see all the announcements', function () {
    seed(AnnouncementSeeder::class);
    seed(PermissionSeeder::class);

    $user = User::factory()->create();
    $user->givePermissionTo('announcements:viewAny');

    $this->actingAs($user)
        ->get(route('announcements.index'))
        ->assertOk();
});

it('prevents user without announcements:viewAny permission from seeing announcements', function () {
    seed(AnnouncementSeeder::class);
    $this->actingAs(User::factory()->create())
        ->get(route('announcements.index'))
        ->assertForbidden();
});
