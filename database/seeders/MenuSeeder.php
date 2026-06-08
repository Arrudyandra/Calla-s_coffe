<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['name' => 'Espresso', 'price' => 20000, 'image' => '/images/black_coffee.png', 'description' => 'Ekstrak kopi murni yang pekat dan kuat.'],
            ['name' => 'Americano', 'price' => 22000, 'image' => '/images/black_coffee.png', 'description' => 'Espresso dengan tambahan air panas.'],
            ['name' => 'Cappucino', 'price' => 28000, 'image' => '/images/milk_coffee.png', 'description' => 'Keseimbangan espresso, susu steam, dan foam.'],
            ['name' => 'Cafe Latte', 'price' => 28000, 'image' => '/images/milk_coffee.png', 'description' => 'Lebih banyak susu steam untuk rasa yang lembut.'],
            ['name' => 'Mocha', 'price' => 32000, 'image' => '/images/milk_coffee.png', 'description' => 'Paduan manisnya cokelat dan espresso.'],
            ['name' => 'Caramel Machiato', 'price' => 35000, 'image' => '/images/milk_coffee.png', 'description' => 'Susu vanilla, espresso, dengan saus karamel.'],
            ['name' => 'Dirty Latte', 'price' => 30000, 'image' => '/images/milk_coffee.png', 'description' => 'Susu dingin yang disiram espresso panas (tanpa diaduk).']
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
