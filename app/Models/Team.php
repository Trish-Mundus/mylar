<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Team extends Model {    
    public $timestamps = false;
    use HasFactory;

	public function random_team(){
return DB::table('team')
                ->select('id')
                ->inRandomOrder()
                ->limit(2)
                ->get();
}
public function get_players($team){

return DB::table('team_players')
                ->select('players_id')
                ->where('team_id',$team)
				->inRandomOrder()
				->limit(1)
                ->get();
}
	//public function players()
    //{
    //    return $this->belongsTo(PlayersModel::class, 'id');
    //}
	//public function team()
    //{
    //    return $this->hasMany(TeamPlayersModel::class, 'team_id');
    //}
}
