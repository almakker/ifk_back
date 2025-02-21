<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Faker\Factory;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        foreach(range(1, 20) as $index) {
            Customer::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'notes' => $faker->optional()->text(100),
            ]);
        }
    }
} 