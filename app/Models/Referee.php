<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\State;
use App\Models\Team;
use App\Models\Players;
use App\Models\Fans;
class Referee extends Model
{
public $timestamps = false;
    use HasFactory;
	 
public function random_referee(){
$referee = DB::table('referee')
                ->inRandomOrder()
                ->first();
return $referee->id;
}
function RandRefAct(){
$rand_act = array('ShowCard','FreeKick','StopGame');
$name = $rand_act[array_rand($rand_act)];
$this->$name();
return $this->$name();
}

protected function ShowCard(){
$color = array('желтая','красная');
	$result = array('показать карточку',$color[array_rand($color)]);
	return $result;
}
protected function FreeKick(){
	$result = array('штрафной',1);
	return $result;
}
protected function StopGame(){
	$result = array('остановить игру','stop');
	return $result;
}
public function StartGame(){
	//формирование игры с рандомными составляющими
	$state = new State;
	$teams = new Team;
	$referee_id = $this->random_referee();
	$state_id = $state->state();
	$teams_id = $teams->random_team();
	// рандомный стадион и начало матча
	$count = DB::table('round_state')->count();
	$round_id = DB::table('round_state')->insertGetId([
                'round' => $count + 1,
				'state_id' => $state_id->id,
				'referee_id' => $referee_id,
				'team1_id' => $teams_id[0]->id,
				'team2_id' => $teams_id[1]->id
	]);
	
	// рандомный сюдья по текущему матчу
	DB::table('referee_action')->insert([
                'who' => 'referee',
                'who_id' => $referee_id,
				'action' => 'начало игры',
				'result' => '0',
				'team_id' => $referee_id,
				'round_id' => $round_id
	]);
	$fans = new Fans;
	$fans_size = $fans->size($state_id->size);
	//для каждой из команд разное кол-во фанатов в сумме вместимость поля
	foreach($fans_size as $fid){
	DB::table('fans_state')->insert([
                'team_id' => $teams_id[rand(0,1)]->id,
				'round_id' => $round_id,
				'fans_id' => $fid->id,
	]);
	}

	return array('round_id'=>$round_id,'teams'=>$teams_id,'referee_id'=>$referee_id);
}
public function actionR($ract,$rid,$pid,$tid,$round_id){


DB::table('referee_action')->insert([
                'who' => 'referee',
                'who_id' => $rid,
				'action' => $ract[0],
				'result' => $ract[1],
				'team_id' => $rid,
				'round_id' => $round_id
	]);
if($ract[0] == 'штрафной'){

DB::table('referee_action')->insert([
                'who' => 'player',
                'who_id' => $pid,
				'action' => 'получил '.$ract[0],
				'result' => 1,
				'team_id' => $tid,
				'round_id' => $round_id
	]);
}	

}
public function Result(){
//$rounds = DB::table('round_state')->('SELECT rs.round, s.state,s.size,r.firstname,r.lastname,r.sex,r.age FROM `round_state` rs LEFT JOIN state s ON(s.id=rs.state_id) LEFT JOIN referee r ON(r.id=rs.referee_id) ORDER By rs.round')->get();
$rounds = DB::table('round_state')
          ->join('state','round_state.state_id','=','state.id')
          ->join('referee','round_state.referee_id','=','referee.id')
		  ->select('round_state.id','round_state.round','round_state.team1_id','round_state.team2_id', 'state.state', 'state.size','referee.firstname','referee.lastname','referee.sex','referee.age')
		  ->orderBy('round_state.round')
          ->get();

$data = array();	  
foreach($rounds as $res){
$group = array();
$teams = DB::table('team')
		  ->select('id','team')
		  ->whereIn('id', [$res->team1_id,$res->team2_id])
		  ->orderBy('id')
          ->get();
foreach($teams as $team){
$players = DB::table('team_players')
          ->join('players','team_players.players_id','=','players.id')
		  ->select('players.id','players.firstname','players.lastname','players.sex','players.age')
		  ->where('team_players.team_id','=',$team->id)
		  ->orderBy('players.id')
          ->get();
$play = array();

$fans = DB::table('fans_state')
          ->join('fans','fans_state.fans_id','=','fans.id')
		  ->select('fans_state.team_id','fans.firstname','fans.lastname','fans.sex','fans.age')
		  ->where('fans_state.team_id','=',$team->id)
		  ->where('fans_state.round_id','=',$res->id)
		  ->orderBy('fans_state.team_id')
          ->get();		  
$group[] = array('team_id'=>$team->id,'team_name'=>$team->team,'players'=>$players,'fans'=>$fans);
}
$action = DB::table('referee_action')
             ->select('id','who','who_id','team_id','action','result')
			 ->where('round_id','=',$res->id)
			 ->get();
$who = array();
$sc = array();

foreach($action as $act){

if($act->who=='referee'){
$whois = 'судья';
$name = $res->firstname.' '.$res->lastname;

} else {
$pl = DB::table('players')
         ->join('team_players','players.id','=','team_players.players_id')
         ->join('team','team_players.team_id','=','team.id')
         ->select('players.firstname','players.lastname','team.id','team.team')->where('players.id','=',$act->who_id)->get();

$whois = 'игрок из команды('.$pl[0]->team.')';
$name = $pl[0]->firstname.' '.$pl[0]->lastname;

$sc[$pl[0]->id][] = (int)$act->result;


}

$who[] = array('action'=>$act->action,'result'=>$act->result,'who_id'=>$act->who_id,'who'=>$whois,'name'=> $name);
}

$s = array();

if(!isset($sc[$res->team1_id])){
$sc[$res->team1_id][] = array(0);
}
if(!isset($sc[$res->team2_id])){
$sc[$res->team2_id][] = array(0);
}

foreach($sc as $val){

$s[] = array_sum($val);

}

$data[] = array('round'=>$res->round,'state_name'=>$res->state,'score'=>implode(' : ',$s),'time'=>'Время '.count($action).'сек','who'=>$who,'state_size'=>$res->size,'referee_name'=>$res->firstname.' '.$res->lastname,'referee_sa'=>$res->age.' years ('.$res->sex.')','teams'=>$group);	
}
  
return array(count($rounds),$data);
}
//public function getTeamsInfo($round_id){
//
//$rounds = DB::table('fans_state')
//          ->join('state','round_state.state_id','=','state.id')
//          ->join('referee','round_state.referee_id','=','referee.id')
//		  ->select('fans_state.team_id','fans_state.fans_id', 'state.state', 'state.size','referee.firstname','referee.lastname','referee.sex','referee.age')
//		  ->where('fans_state.round_id','=',$round_id)
//		  ->orderBy('round_state.round')
//          ->get();
//return $rounds;
//}

}
