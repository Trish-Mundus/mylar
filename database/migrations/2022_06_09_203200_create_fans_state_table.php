<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFansStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	if (!Schema::hasTable('fans_state')) {
        Schema::create('fans_state', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('team_id');
			$table->bigInteger('round_id');
			$table->bigInteger('fans_id');
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
        Schema::dropIfExists('fans_state');
    }
}
