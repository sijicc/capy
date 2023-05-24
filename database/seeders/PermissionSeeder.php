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
    }
}
