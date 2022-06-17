<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = \Faker\Factory::create();
	for($i=0; $i<100; $i++){
         DB::table('fans')->insert([
		  'firstname' => $faker->firstName(),
          'lastname' => $faker->lastName(),
		  'sex' => $faker->randomElement(['male', 'female']),
		  'age' => $faker->numberBetween(21, 80),
        ]);
		}
    }
}
