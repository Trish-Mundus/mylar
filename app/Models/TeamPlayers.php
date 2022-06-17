<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Team;
class TeamPlayers extends Model
{public $timestamps = false;
    use HasFactory;
	
	public function teamplayer()
    {
        return $this->belongsToMany(Team::class, 'id');
    }
	
	//'user_id' => User::Factory(),
}
