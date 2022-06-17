<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Players extends Model
{
public $timestamps = false;
    use HasFactory;
	//public function 
	//public function teams()
    //{
    //    return $this->hasMany(Team::class, 'id');
    //}
	
function RandPlayAct(){
$rand_act = array('Pass','HitOnGoal');
$name = $rand_act[array_rand($rand_act)];
//$this->$name();
return $this->$name();
}
function Pass(){
	$result = array('дать пасс','0');
	return $result;
}
function HitOnGoal(){
$res = (bool)random_int(0, 1);
	$result = array('ударить по воротам',$res );
	return $result;
}
public function actionP($pact,$pid,$tid,$round_id){
//$pl = $this->RandPlayAct();
//foreach($this->RandPlayAct() as $key=>$val){
//$pl[$key] = 
//}
DB::table('referee_action')->insert([
                'who' => 'player',
                'who_id' => $pid,
				'action' => $pact[0],
				'result' => $pact[1],
				'team_id' => $tid,
				'round_id' => $round_id
	]);
	//return array($pl);
}

}
