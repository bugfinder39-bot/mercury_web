<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed default admin users
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@mercury.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        User::create([
            'name' => 'Content Editor',
            'email' => 'editor@mercury.com',
            'password' => Hash::make('password'),
            'role' => 'content_editor',
        ]);

        // Run component and content seeders
        $this->call([
            PageSeeder::class,
            ServiceSeeder::class,
            PartnerSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
