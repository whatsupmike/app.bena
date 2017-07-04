<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassengerTripPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passenger_trip', function (Blueprint $table) {
            $table->increments('passenger_trip_id');

            $table->integer('passenger_id')->unsigned();
            $table->integer('trip_id')->unsigned();

            $table->foreign('passenger_id')->references('passenger_id')->on('passengers');
            $table->foreign('trip_id')->references('trip_id')->on('trips');

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
        Schema::dropIfExists('passenger_trip');
    }
}
