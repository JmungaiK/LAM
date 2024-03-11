<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Administrator;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Call the seeder to create admin user
        $this->call(AdminUserSeeder::class);

        // Call the seeder to add admin user to administrators table
        $this->call(AdministratorSeeder::class);
    }
}

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $adminUser = User::create([
            'user_name' => 'admin',
            'user_email' => 'admin@example.com',
            'user_password' => bcrypt('admin123'),
            'user_role' => 'admin', // Assign admin role
        ]);
    }
}

class AdministratorSeeder extends Seeder
{
    public function run()
    {
        // Retrieve admin user's ID
        $adminUserId = User::where('user_email', 'admin@example.com')->first()->user_id;

        // Insert admin user's ID into administrators table
        Administrator::create([
            'user_id' => $adminUserId,
        ]);
    }
}
