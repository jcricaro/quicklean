<?php

use Illuminate\Database\Seeder;
use App\Machine;

class MachinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Machine::truncate();

        foreach(range(1, 5) as $index) {
        	Machine::create([
        		'name' => "Washer $index",
        		'type' => 'Washer'
        		]);
        }

        foreach(range(1, 3) as $index) {
        	Machine::create([
        		'name' => "Dryer $index",
        		'type' => 'Dryer'
        		]);
        }
    }
}
