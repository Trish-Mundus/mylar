<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefereeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	if (!Schema::hasTable('referee')) {
	Schema::create('referee', function (Blueprint $table) {
            $table->id();
            $table->string('firstname',128);
            $table->string('lastname',128);
            $table->string('sex',50);
            $table->tinyInteger('age');
        });  
		//DB:: statement ("ALTER TABLE `referee`");//table comment"
    }
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referee');
    }
}
