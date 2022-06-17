<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefereeActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	if (!Schema::hasTable('referee_action')) {
        Schema::create('referee_action', function (Blueprint $table) {
            $table->id();
			$table->string('who',128);
			$table->bigInteger('who_id');
			$table->string('action',128);
			$table->string('result',128);
			$table->bigInteger('team_id');
			$table->bigInteger('round_id');
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
        Schema::dropIfExists('referee_action');
    }
}
