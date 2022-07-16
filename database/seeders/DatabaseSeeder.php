<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        $menus = $this->createListOfMenus();
        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }

    private function createListOfMenus()
    {
        return [
            [
                'title' => 'Macaroni',
                'desc' => 'Very delicious pasta with cheese',
                'price' => 350,
                'category' => 'pasta',
                'path' => 'images/default.jpg',
            ],
            [
                'title' => 'Four Cheese',
                'desc' => 'Very delicious pizza with cheese',
                'price' => 400,
                'category' => 'pizza',
                'path' => 'images/default.jpg',
            ],
            [
                'title' => 'Lasagna',
                'desc' => 'Very delicious lasagna with white sauce and cheese',
                'price' => 380,
                'category' => 'pasta',
                'path' => 'images/default.jpg',
            ],
            [
                'title' => 'Spaghetti',
                'desc' => 'Very delicious spaghetti like mine apollo',
                'price' => 300,
                'category' => 'pasta',
                'path' => 'images/default.jpg',
            ],
        ];
    }
}
