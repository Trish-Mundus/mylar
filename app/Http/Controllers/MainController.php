<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;//
//use App\Models\Form;
use App\Models\Referee;
use App\Models\Team;
use App\Models\Players;
use App\Models\State;
use App\Models\Game;
//use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;
//use Illuminate\Support\Facades\Redirect;
//use Illuminate\Routing\Redirector;
class MainController extends Controller
{
    //
	public function index(){
	
	return view('welcome');
	}
	public function test(){
	$form = new Form();
	return view('test',['data'=>$form->all()]);
	}
	 /**
     * Сохранить новую запись в блоге.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function start_game(){
	ini_set('max_execution_time', 900);
	$referee = new Referee;
	//if(count($result)>=5){dd(count($result));}
	if($referee->Result()[0]<5){
	$pl_act = new Players;
	$teams = new Team;

	for ($x=0; $x++<5;){
	$start = $referee->StartGame();

	$player = $teams->get_players($start['teams'][0]->id);
	$player2 = $teams->get_players($start['teams'][1]->id);
	
	$ract[0]='start';
	while($ract[0]!='остановить игру'){
	$pact = $pl_act->RandPlayAct();
	if($pact[0]=='дать пасс'){
	$pl_act->actionP($pact,$player[0]->players_id,$start['teams'][0]->id,$start['round_id']);
	$player = $teams->get_players($start['teams'][0]->id);
	sleep(1);
	$pact = $pl_act->RandPlayAct();
	sleep(1);
	$ract = $referee->RandRefAct();
	$referee->actionR($ract,$start['referee_id'],$player[0]->players_id,$start['teams'][0]->id,$start['round_id']);
	sleep(1);
	}else if($pact[0]=='ударить по воротам'){
	if($pact[1]==0){
	$pl_act->actionP($pact,$player[0]->players_id,$start['teams'][0]->id,$start['round_id']);
	$pact = $pl_act->RandPlayAct();
	$pl_act->actionP($pact,$player2[0]->players_id,$start['teams'][1]->id,$start['round_id']);
	sleep(1);
	$ract = $referee->RandRefAct();
	$referee->actionR($ract,$start['referee_id'],$player2[0]->players_id,$start['teams'][1]->id,$start['round_id']);
	sleep(1);
	}else{
	$pl_act->actionP($pact,$player[0]->players_id,$start['teams'][0]->id,$start['round_id']);
	sleep(1);
	$pact = $pl_act->RandPlayAct();
	sleep(1);
	$ract = $referee->RandRefAct();
	$referee->actionR($ract,$start['referee_id'],$player[0]->players_id,$start['teams'][0]->id,$start['round_id']);
	sleep(1);
	}
	}
	}
	sleep(1);
	}
	}
	$result = $referee->Result();

	//dd($result[1]);
	return view('result',['result'=>$result[1]]);
	}
	

	//public function t_check(Request $data){
	////dd($data);
	//$valid = $data->validate([
	//    'email' => 'required|min:4|max:100',
	//    'subject' => 'min:5|max:100',
	//    'text' => 'min:10|max:100',
	//]);
	//$form = new Form();
	//$form->email = $data->input('email');
	//$form->theme = $data->input('subject');
	//$form->text = $data->input('text');
	//$form->save();
	//
    //
	//return redirect()->route('test');
	////return Redirect::route('locations.index');
	//}
}
