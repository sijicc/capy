<?php

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('doesn\'t allow guests to edit announcements', function () {
    // TODO: this should get moved to AnnouncementControllerTest
    $announcement = App\Models\Announcement::factory()->create();

    $this->get(route('announcements.edit', $announcement))
        ->assertRedirect(route('login'));
});

//it('doesn\'t allow any user to edit published announcement', function () {
//    // TODO: this should get moved to AnnouncementControllerTest
//    $announcement = App\Models\Announcement::factory()->create();
//    $announcement->publish();
//
//    $user = App\Models\User::factory()->create();
//
//    $this->actingAs($user)
//        ->get(route('announcements.edit', $announcement))
//        ->assertForbidden();
//
//    seed(RoleSeeder::class);
//
//    $admin = App\Models\User::factory()->create();
//    $admin->assignRole(Role::firstWhere('name', 'admin'));
//
//    $this->actingAs($admin)
//        ->get(route('announcements.edit', $announcement))
//        ->assertForbidden();
//});

//it('allows user to edit unpublished announcement', function () {
//    $announcement = Announcement::create([
//        'title' => 'title',
//        'content' => 'content',
//        'publish_at' => now()->addDay(),
//    ]);
//
//    // TODO: this should get moved to AnnouncementControllerTest
//    $this->actingAs(User::factory()->create())
//        ->get(route('announcements.edit', $announcement))
//        ->assertOk();
//
//    $updates = [
//        'title' => 'new title',
//        'content' => 'new content',
//        'publish_at' => now()->addWeek(),
//    ];
//
//    livewire('announcements.edit', ['announcement' => $announcement])
//        ->set('title', $updates['title'])
//        ->set('content', $updates['content'])
//        ->set('publish_at', $updates['publish_at'])
//        ->call('submit')
//        ->assertRedirect(route('announcements.index'));
//
//    $this->assertDatabaseHas('announcements', $updates);
//});
