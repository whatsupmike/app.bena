<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('trip_id');

            $table->integer('car_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('odometerBefore');
            $table->integer('odometerAfter');

            $table->string('slug')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('car_id')->references('car_id')->on('cars');
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
