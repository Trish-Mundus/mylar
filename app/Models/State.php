<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class State extends Model
{
public $timestamps = false;
    use HasFactory;
	
	public function state(){
	
	return DB::table('state')
	           ->select('id','size')
			   ->inRandomOrder()
			   ->first();
	}
}
