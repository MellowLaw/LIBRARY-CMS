<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class DefaultMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing menus
        Menu::query()->delete();

        // Create default navigation menu items
        $menus = [
            [
                'name' => 'home',
                'label' => 'Home',
                'url' => '/',
                'display_order' => 1,
                'is_visible' => true,
            ],
            [
                'name' => 'news',
                'label' => 'News',
                'url' => '/public/news',
                'display_order' => 2,
                'is_visible' => true,
            ],
            [
                'name' => 'staff',
                'label' => 'Staff',
                'url' => '/public/staff',
                'display_order' => 3,
                'is_visible' => true,
            ],
            [
                'name' => 'resources',
                'label' => 'Resources',
                'url' => '/public/resources',
                'display_order' => 4,
                'is_visible' => false, // Hidden from public menu
            ],
            [
                'name' => 'books',
                'label' => 'Books',
                'url' => '/public/books',
                'display_order' => 5,
                'is_visible' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        $this->command->info('Default menu items created successfully!');
    }
}
