<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	if (!Schema::hasTable('team_players')) {
        Schema::create('team_players', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('team');
			$table->bigInteger('players_id')->unsigned();
            $table->foreign('players_id')->references('id')->on('players');
            //$table->bigInteger('team_id');
            //$table->bigInteger('players_id');
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_players');
    }
}
