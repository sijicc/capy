<?php

namespace App\Models;

use App\TemplatingEngine\AllowsToGenerateForm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements AllowsToGenerateForm
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function readAnnouncements(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Announcement::class,
            table: 'announcement_user',
            foreignPivotKey: 'user_id',
            relatedPivotKey: 'announcement_id'
        )->withPivot('read_at');
    }

    public static function getFields(): array
    {
        return [
            'name',
            'email',
            'email_verified_at',
            'created_at',
            'updated_at',
        ];
    }
}
