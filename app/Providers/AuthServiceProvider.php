<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Invoice;
use App\Models\Setting;
use App\Models\User;
use App\Policies\AnnouncementPolicy;
use App\Policies\InvoicePolicy;
use App\Policies\RolePolicy;
use App\Policies\SettingPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        Invoice::class => InvoicePolicy::class,
        Announcement::class => AnnouncementPolicy::class,
        Setting::class => SettingPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function (User $user) {
            return $user->hasRole('admin') ? true : null;
        });
    }
}
