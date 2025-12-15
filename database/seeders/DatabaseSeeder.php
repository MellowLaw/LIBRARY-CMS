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
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@library.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create Librarian User
        User::create([
            'name' => 'Librarian User',
            'email' => 'librarian@library.com',
            'password' => Hash::make('password'),
            'role' => 'librarian',
            'is_active' => true,
        ]);

        // Create Viewer User
        User::create([
            'name' => 'Viewer User',
            'email' => 'viewer@library.com',
            'password' => Hash::make('password'),
            'role' => 'viewer',
            'is_active' => true,
        ]);

        $this->command->info('✅ Created 3 users:');
        $this->command->info('   - Admin: admin@library.com / password');
        $this->command->info('   - Librarian: librarian@library.com / password');
        $this->command->info('   - Viewer: viewer@library.com / password');
    }
}
