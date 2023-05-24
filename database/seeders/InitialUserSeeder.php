<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class InitialUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Jakub Sitarz',
            'email' => 'j.sitarz@it4eb.com',
            'password' => bcrypt('j.sitarz@it4eb.com'),
        ]);

        $user->assignRole('admin');
    }
}
