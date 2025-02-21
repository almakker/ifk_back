<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Hotel;
use Illuminate\Database\Seeder;
use Faker\Factory;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $hotels = Hotel::all();
        $customers = Customer::all();

        foreach(range(1, 30) as $index) {
            $checkIn = $faker->dateTimeBetween('-1 month', '+1 month');
            $checkOut = $faker->dateTimeBetween($checkIn, $checkIn->format('Y-m-d H:i:s').' +7 days');
            
            $booking = Booking::create([
                'hotel_id' => $hotels->random()->id,
                'room_number' => $faker->numberBetween(100, 999),
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'status' => $faker->randomElement(Booking::STATUSES),
                'notes' => $faker->optional()->text(200),
            ]);

            // Add random number of guests (1-3)
            $bookingCustomers = $customers->random(rand(1, 3));
            foreach($bookingCustomers as $i => $customer) {
                $booking->customers()->attach($customer->id, [
                    'is_main' => $i === 0 // first added customer will be main
                ]);
            }
        }
    }
} 