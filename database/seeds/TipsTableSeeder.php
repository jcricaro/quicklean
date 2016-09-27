<?php

use Illuminate\Database\Seeder;
use App\Tip;
use Faker\Factory as Faker;

class TipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tip::truncate();
        $faker = Faker::create();

        foreach(range(1,5) as $index) {
        	Tip::create([
        		'title' => $faker->sentence,
        		'content' => $faker->sentence(5)
        		]);
        }
    }
}
