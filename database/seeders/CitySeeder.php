<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            'japan' => [
                [
                    'name' => 'Tokyo'
                ],
                [
                    'name' => 'Yokohama'
                ],
                [
                    'name' => 'Kyoto'
                ],
                [
                    'name' => 'Osaka'
                ],
                [
                    'name' => 'Sapporo'
                ],
                [
                    'name' => 'Nagoya'
                ]
            ]
        ];

        foreach ($cities['japan'] as $city) {
            City::create(['name' => $city['name']]);
        }
    }
}
