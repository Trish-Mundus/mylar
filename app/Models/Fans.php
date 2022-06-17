<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Fans extends Model
{
public $timestamps = false;
    use HasFactory;
	
public function size($qty)	{
return DB::table('fans')->select('id')->inRandomOrder()->limit($qty)->get();
}
	
}
