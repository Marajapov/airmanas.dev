<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassengerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passenger', function (Blueprint $table) {
            $table->increments('id');
			$table->string('sex');
			$table->string('name');
			$table->string('surname');
			$table->string('name_latin');
			$table->string('surname_latin');
			$table->string('birthday');
			$table->string('flight');			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('passenger');
    }
}
