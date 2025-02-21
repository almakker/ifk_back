<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    public function run()
    {
        $hotels = [
            [
                'name' => 'Moscow Ritz-Carlton',
                'address' => '3 Tverskaya Street, Moscow',
                'description' => 'Central Moscow hotel with city views',
                'is_active' => true,
            ],
            [
                'name' => 'Sochi Marriott Resort',
                'address' => '11 Morskoy Boulevard, Sochi',
                'description' => 'Beach hotel in Sochi',
                'is_active' => true,
            ],
            [
                'name' => 'Altai Mountain Lodge',
                'address' => '24 Chuysky Tract, Altai Republic',
                'description' => 'Mountain hotel in Altai',
                'is_active' => true,
            ],
            [
                'name' => 'St. Petersburg Four Seasons',
                'address' => '1 Voznesensky Prospekt, St. Petersburg',
                'description' => 'City center hotel in St. Petersburg',
                'is_active' => true,
            ],
            [
                'name' => 'Baikal View Resort',
                'address' => '15 Primorsky Boulevard, Listvyanka',
                'description' => 'Lake view hotel in Listvyanka',
                'is_active' => true,
            ],
        ];

        foreach ($hotels as $hotel) {
            Hotel::create($hotel);
        }
    }
} 