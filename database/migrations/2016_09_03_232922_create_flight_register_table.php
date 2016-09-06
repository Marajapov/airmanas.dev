<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlightRegisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight_register', function (Blueprint $table) {
            $table->increments('id');
			$table->string('ip');
			$table->string('name');
			$table->string('surname');
			$table->string('phone');
			$table->string('email');
			$table->integer('price');
			$table->string('departure');
			$table->string('destination');
			$table->string('departure_flight');
			$table->string('return_flight');
			$table->string('pay_till');
			$table->string('paycode');
			$table->integer('paid_sum');
			$table->integer('paid_extra');
			$table->string('paid_flag');
			$table->string('pnrcode');
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
        Schema::drop('flight_register');
    }
}
