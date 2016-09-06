<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTtransactlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ttransactlog', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('txn_id');
			$table->string('account');
			$table->integer('sum');
			$table->string('osmp_txn_id');
			$table->string('result');
			$table->string('service');			
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
        Schema::drop('ttransactlog');
    }
}
