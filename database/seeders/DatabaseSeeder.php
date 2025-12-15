<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@library.com'],
            [
                'name' => 'Admin User',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // Create Librarian User
        User::firstOrCreate(
            ['email' => 'librarian@library.com'],
            [
                'name' => 'Librarian User',
                'first_name' => 'Librarian',
                'last_name' => 'User',
                'password' => Hash::make('password'),
                'role' => 'librarian',
                'is_active' => true,
            ]
        );

        // Create Viewer User
        User::firstOrCreate(
            ['email' => 'viewer@library.com'],
            [
                'name' => 'Viewer User',
                'first_name' => 'Viewer',
                'last_name' => 'User',
                'password' => Hash::make('password'),
                'role' => 'viewer',
                'is_active' => true,
            ]
        );



        $this->command->info('✅ Created 3 users:');
        $this->command->info('   - Admin: admin@library.com / password');
        $this->command->info('   - Librarian: librarian@library.com / password');
        $this->command->info('   - Viewer: viewer@library.com / password');
    }
}
