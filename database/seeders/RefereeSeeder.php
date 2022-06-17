<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefereeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	 $faker = \Faker\Factory::create();
	for($i=1; $i<5; $i++){
         DB::table('referee')->insert([
		  'firstname' => $faker->firstName(),
          'lastname' => $faker->lastName(),
		  'sex' => $faker->randomElement(['male', 'female']),
		  'age' => $faker->numberBetween(25, 50),
        ]);
		}
    }
}
