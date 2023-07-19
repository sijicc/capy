<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'users:viewAny']);
        Permission::create(['name' => 'users:view']);
        Permission::create(['name' => 'users:create']);
        Permission::create(['name' => 'users:update']);
        Permission::create(['name' => 'users:delete']);

        Permission::create(['name' => 'companies:viewAny']);
        Permission::create(['name' => 'companies:view']);
        Permission::create(['name' => 'companies:create']);
        Permission::create(['name' => 'companies:update']);
        Permission::create(['name' => 'companies:delete']);

        Permission::create(['name' => 'roles:viewAny']);
        Permission::create(['name' => 'roles:view']);
        Permission::create(['name' => 'roles:create']);
        Permission::create(['name' => 'roles:update']);
        Permission::create(['name' => 'roles:delete']);

        Permission::create(['name' => 'announcements:viewAny']);
        Permission::create(['name' => 'announcements:view']);
        Permission::create(['name' => 'announcements:create']);
        Permission::create(['name' => 'announcements:update']);
        Permission::create(['name' => 'announcements:delete']);
    }
}
