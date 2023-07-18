<?php

use App\Models\Announcement;
use App\Models\User;
use App\Notifications\NewAnnouncementNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\get;
use function Pest\Laravel\travel;
use function Pest\Livewire\livewire;

uses(RefreshDatabase::class);

it('doesn\'t allow guest to create announcement', function () {
    get(route('announcements.create'))
        ->assertRedirect(route('login'));
});

it('allows user to create announcement with correct data', function () {
    actingAs(User::factory()->create());

    $announcement = [
        'title' => fake()->sentence(),
        'content' => fake()->paragraph(),
    ];

    livewire('announcements.create')
        ->set('title', $announcement['title'])
        ->set('content', $announcement['content'])
        ->call('submit')
        ->assertRedirect(route('announcements.index'));

    assertDatabaseHas('announcements', $announcement);
});

it('doesn\'t allow user to create announcement with incorrect data', function () {
    actingAs(User::factory()->create());

    $announcement = [
        'title' => null,
        'content' => null,
    ];

    livewire('announcements.create')
        ->set('title', $announcement['title'])
        ->set('content', $announcement['content'])
        ->call('submit')
        ->assertHasErrors(['title', 'content']);

    assertDatabaseMissing('announcements', $announcement);
});

test('that notifications are sent if selected', function () {
    Notification::fake();
    actingAs(User::factory()->create());

    $announcement = [
        'title' => fake()->sentence(),
        'content' => fake()->paragraph(),
        'should_email' => true,
        'should_notify' => true,
    ];

    livewire('announcements.create')
        ->set('title', $announcement['title'])
        ->set('content', $announcement['content'])
        ->set('should_email', $announcement['should_email'])
        ->set('should_notify', $announcement['should_notify'])
        ->call('submit')
        ->assertRedirect(route('announcements.index'));

    Notification::assertSentTo(User::all(), NewAnnouncementNotification::class);

    assertDatabaseHas('announcements', $announcement);
});

test('that notifications are not sent if not selected', function () {
    Notification::fake();
    actingAs(User::factory()->create());

    $announcement = [
        'title' => fake()->sentence(),
        'content' => fake()->paragraph(),
        'should_email' => false,
        'should_notify' => false,
    ];

    livewire('announcements.create')
        ->set('title', $announcement['title'])
        ->set('content', $announcement['content'])
        ->set('should_email', $announcement['should_email'])
        ->set('should_notify', $announcement['should_notify'])
        ->call('submit')
        ->assertRedirect(route('announcements.index'));

    Notification::assertNotSentTo(User::all(), NewAnnouncementNotification::class);

    assertDatabaseHas('announcements', $announcement);
});

test('that notifications are not sent unless announcement is published', function () {
    Notification::fake();
    actingAs(User::factory()->create());

    $announcement = [
        'title' => fake()->sentence(),
        'content' => fake()->paragraph(),
        'publish_at' => now()->addDay(),
        'should_email' => true,
        'should_notify' => true,
    ];

    livewire('announcements.create')
        ->set('title', $announcement['title'])
        ->set('content', $announcement['content'])
        ->set('should_email', $announcement['should_email'])
        ->set('should_notify', $announcement['should_notify'])
        ->set('publish_at', $announcement['publish_at'])
        ->call('submit')
        ->assertRedirect(route('announcements.index'));

    Notification::assertNotSentTo(User::all(), NewAnnouncementNotification::class);

    travel(2)->days();
    Announcement::first()->publish();

    Notification::assertSentTo(User::all(), NewAnnouncementNotification::class);

    assertDatabaseHas('announcements', $announcement);
});
