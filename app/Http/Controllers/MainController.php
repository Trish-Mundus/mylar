<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;//
use App\Models\Form;
use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;
//use Illuminate\Support\Facades\Redirect;
//use Illuminate\Routing\Redirector;
class MainController extends Controller
{
    //
	public function home(){
	
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
	public function t_check(Request $data){
	//dd($data);
	$valid = $data->validate([
	    'email' => 'required|min:4|max:100',
	    'subject' => 'min:5|max:100',
	    'text' => 'min:10|max:100',
	]);
	$form = new Form();
	$form->email = $data->input('email');
	$form->theme = $data->input('subject');
	$form->text = $data->input('text');
	$form->save();
	

	return redirect()->route('test');
	//return Redirect::route('locations.index');
	}
}
