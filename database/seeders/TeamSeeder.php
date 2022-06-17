<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TeamSeeder extends Seeder
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
         DB::table('team')->insert([
		  'team' => $faker->city().' '.$faker->colorName(),
        ]);
		}
    }
}
