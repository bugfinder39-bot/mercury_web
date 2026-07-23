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
        User::firstOrCreate(
            ['email' => 'admin@mercury.com'],
            [
                'name' => 'Super Admin',
                'password' => 'password',
                'role' => 'super_admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'editor@mercury.com'],
            [
                'name' => 'Content Editor',
                'password' => 'password',
                'role' => 'content_editor',
            ]
        );

        // Run component and content seeders
        $this->call([
            PageSeeder::class,
            ServiceSeeder::class,
            PartnerSeeder::class,
            SettingSeeder::class,
            DashboardWidgetSeeder::class,
        ]);
    }
}
