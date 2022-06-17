<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = \Faker\Factory::create();
	     for($i=0; $i<70; $i++){
         DB::table('players')->insert([
		  'firstname' => $faker->firstName(),
          'lastname' => $faker->lastName(),
		  'sex' => $faker->randomElement(['male', 'female']),
		  'age' => $faker->numberBetween(21, 30),
        ]);
		}
    }
}
