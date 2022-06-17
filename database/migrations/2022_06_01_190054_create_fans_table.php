<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	if (!Schema::hasTable('fans')) {
        Schema::create('fans', function (Blueprint $table) {
          $table->id();
            $table->string('firstname',128);
            $table->string('lastname',128);
            $table->string('sex',50);
            $table->tinyInteger('age');
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
        Schema::dropIfExists('fans');
    }
}
