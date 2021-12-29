<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Food'
            ],
            [
                'name' => 'Shopping'
            ],
            [
                'name' => 'Trending'
            ],
            [
                'name' => 'Top Picks'
            ],
            [
                'name' => 'Fun'
            ],
            [
                'name' => 'Nightlife'
            ]
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category['name']]);
        }
    }
}
