<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamPlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	 
    public function run()
    {
	$players = DB::select('select id from players');
	$team = DB::select('select id from team');
	shuffle($players);

$pl = array_chunk($players,14);

for ($i=0;$i<=count($team)-1;$i++) {

foreach($pl[$i] as $player){
   DB::table('team_players')->insert([
		  'players_id' => $player->id,
		  'team_id' => $team[$i]->id
        ]);
		}
}

    }
}
