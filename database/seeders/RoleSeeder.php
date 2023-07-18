<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::create([
            'pretty_name' => 'Administrator',
            'description' => 'Administrators have full access to the application.',
            'name' => 'admin',
            'is_removable' => false,
        ]);
        $admin->syncPermissions(Permission::all()->pluck('name'));
    }
}
