<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTtransactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ttransact', function (Blueprint $table) {
            $table->increments('id');
			$table->string('txn_id');
			$table->string('account');
			$table->integer('money');
			$table->string('method');
			$table->string('status');
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
        Schema::drop('ttransact');
    }
}
