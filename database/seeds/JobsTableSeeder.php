<?php

use Illuminate\Database\Seeder;
use App\Job;
use Faker\Factory as Faker;
use App\Machine;
use Carbon\Carbon;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::truncate();

        $faker = Faker::create();

        foreach( range(1, 5) as $index ) {

            Job::create([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'service_type' => $faker->randomElement(['self', 'employee']),
                'kilogram' => $faker->randomElement(['8', '16']),
                'washer_mode' => $faker->randomElement(['clean', 'cleaner', 'cleanest']),
                'dryer_mode' => $faker->randomElement(['19' ,'24', '29']),
                'detergent' => $faker->randomElement(['ariel', 'pride', 'tide', 'i_have_one']),
                'bleach' => $faker->randomElement(['colorsafe', 'original', 'i_have_one']),
                'fabric_conditioner' => $faker->randomElement(['downy', 'i_have_one']),
                'is_press' => $faker->boolean,
                'is_fold' => $faker->boolean,
                'status' => 'pending'
            ]);
        }

        foreach( range(1, 5) as $index ) {
            Job::create([
                'name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'service_type' => $faker->randomElement(['self', 'employee']),
                'kilogram' => $faker->randomElement(['8', '16']),
                'washer_mode' => $faker->randomElement(['clean', 'cleaner', 'cleanest']),
                'dryer_mode' => $faker->randomElement(['19' ,'24', '29']),
                'detergent' => $faker->randomElement(['ariel', 'pride', 'tide', 'i_have_one']),
                'bleach' => $faker->randomElement(['colorsafe', 'original', 'i_have_one']),
                'fabric_conditioner' => $faker->randomElement(['downy', 'i_have_one']),
                'is_press' => $faker->boolean,
                'is_fold' => $faker->boolean,
                'status' => 'pending',
                'reserve_at' => Carbon::now()->addMinutes($index * 5)
                ]);
        }

    }
}
