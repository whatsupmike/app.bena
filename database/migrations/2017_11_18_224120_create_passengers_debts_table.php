<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassengersDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers_debts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('passenger_id')->unsigned();
            $table->double('toPay');
            $table->boolean('isPaid');

            $table->foreign('passenger_id')->references('passenger_id')->on('passengers');

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
        Schema::dropIfExists('passengers_debts');
    }
}
