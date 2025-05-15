<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Users admin

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '01000000000',
            'password' => 'password',
        ]);

        $admin->assignRole('admin');

        // Users user

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '01234567890',
            'password' => 'password',
        ]);
        $user->assignRole('user');
    }
}
