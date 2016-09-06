<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nameEn');
            $table->string('country_code');
            $table->string('city_code');
            $table->string('airport_code');
            $table->string('airport_name');
            $table->string('airport_nameEn');
            $table->enum('status', ['new', 'published','closed','deleted'])->nullable()->default('new');
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
        Schema::drop('cities');
    }
}
