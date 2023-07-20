<?php

namespace App\Models;

use App\Notifications\NewAnnouncementNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Notification;

class Announcement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_pinned' => 'boolean',
        'should_notify' => 'boolean',
        'should_email' => 'boolean',
        'published_at' => 'datetime',
        'publish_at' => 'datetime',
    ];

    public function publish(): void
    {
        if ($this->should_notify || $this->should_email) {
            Notification::send(User::all(), new NewAnnouncementNotification($this));
        }

        $this->update([
            'published_at' => now(),
        ]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isPublished(): bool
    {
        return $this->published_at !== null;
    }

    public function isNotPublished(): bool
    {
        return !$this->isPublished();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeUnpublished(Builder $query): Builder
    {
        return $query->whereNull('published_at');
    }

    public function readers(): BelongsToMany
    {
        return $this->belongsToMany(User::class,
            table: 'announcement_user',
            foreignPivotKey: 'announcement_id',
            relatedPivotKey: 'user_id'
        )->withPivot('read_at');
    }
}
