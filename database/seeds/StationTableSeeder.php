<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;

class StationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
            	$faker = Faker::create();
            	foreach (range(1,3) as $index) {
        	        DB::table('stations')->insert([
        	            'station_key' => str_random(15),
        	            'station_name' => $faker->name,
        	        ]);
                }
    }
}
