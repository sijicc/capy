<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Announcement extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'is_pinned' => 'boolean',
        'should_notify' => 'boolean',
        'should_email' => 'boolean',
        'published_at' => 'datetime',
        'publish_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
