<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	$faker = \Faker\Factory::create();
        for($i=0; $i<10; $i++){
         DB::table('state')->insert([
		  'state' => $faker->colorName().' '.$faker->country(),
		  'size' => rand(40,100),
        ]);
		}
    }
}
