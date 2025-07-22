<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeedersTable extends Seeder
{
    public function run(): void
    {
        User::create([
            'role' => 'event_admin',
            'name' => 'Event Admin',
            'email' => 'event_admin@example.com',
            'profile_image' => '',
            'password' => Hash::make('password')
        ]);

        User::create([
            'role' => 'user',
            'name' => 'Taylor',
            'email' => 'taylor@example.com',
            'profile_image' => '',
            'password' => Hash::make('password')
        ]);

        User::create([
            'role' => 'user',
            'name' => 'Swift',
            'email' => 'swift@example.com',
            'profile_image' => '',
            'password' => Hash::make('password')
        ]);
    }
}
