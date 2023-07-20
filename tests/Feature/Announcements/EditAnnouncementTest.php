<?php

use App\Models\Announcement;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use function Pest\Livewire\livewire;

uses(LazilyRefreshDatabase::class);

it('allows user to edit announcement with correct data', function () {
    $announcement = Announcement::factory()->unpublished()->create();

    $updates = [
        'title' => 'new title',
        'content' => 'new content',
        'publish_at' => now()->addWeek(),
    ];

    livewire('announcements.edit-announcement', ['announcement' => $announcement])
        ->set('title', $updates['title'])
        ->set('content', $updates['content'])
        ->set('publish_at', $updates['publish_at'])
        ->call('submit')
        ->assertRedirect(route('announcements.index'));

    $this->assertDatabaseHas('announcements', $updates);
});

it('prevents user from editing announcement with too long title', function () {
    $announcement = Announcement::factory()->unpublished()->create();

    $updates = [
        'title' => str_repeat('a', 256),
        'content' => 'new content',
        'publish_at' => now()->addWeek(),
    ];

    livewire('announcements.edit-announcement', ['announcement' => $announcement])
        ->set('title', $updates['title'])
        ->set('content', $updates['content'])
        ->set('publish_at', $updates['publish_at'])
        ->call('submit')
        ->assertHasErrors(['title' => 'max']);

    $this->assertDatabaseMissing('announcements', $updates);
});

it('prevents user from editing announcement with too long content', function () {
    $announcement = Announcement::factory()->unpublished()->create();

    $updates = [
        'title' => 'new title',
        'content' => str_repeat('a', 65536),
        'publish_at' => now()->addWeek(),
    ];

    livewire('announcements.edit-announcement', ['announcement' => $announcement])
        ->set('title', $updates['title'])
        ->set('content', $updates['content'])
        ->set('publish_at', $updates['publish_at'])
        ->call('submit')
        ->assertHasErrors(['content' => 'max']);

    $this->assertDatabaseMissing('announcements', $updates);
});

it('prevents user from editing announcement with publish_at in the past', function () {
    $announcement = Announcement::factory()->unpublished()->create();

    $updates = [
        'title' => 'new title',
        'content' => 'new content',
        'publish_at' => now()->subWeek(),
    ];

    livewire('announcements.edit-announcement', ['announcement' => $announcement])
        ->set('title', $updates['title'])
        ->set('content', $updates['content'])
        ->set('publish_at', $updates['publish_at'])
        ->call('submit')
        ->assertHasErrors(['publish_at' => 'after_or_equal']);

    $this->assertDatabaseMissing('announcements', $updates);
});
