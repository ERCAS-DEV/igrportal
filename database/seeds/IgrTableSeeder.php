<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;

class IgrTableSeeder extends Seeder
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
        	        DB::table('igrs')->insert([
        	            'igr_key' => str_random(15),
        	            'state_name' => $faker->name,
        	            'igr_code' =>  str_random(4),
        	            'igr_abbre' => $faker->lastName,
        	        ]);
                }
    }
}
