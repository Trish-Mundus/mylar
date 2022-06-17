<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoundStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	if (!Schema::hasTable('round_state')) {
        Schema::create('round_state', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('round');
			$table->bigInteger('state_id');
			$table->bigInteger('referee_id');
			$table->bigInteger('team1_id');
			$table->bigInteger('team2_id');
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
        Schema::dropIfExists('round_state');
    }
}
