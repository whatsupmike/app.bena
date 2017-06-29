<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuels', function (Blueprint $table) {
            $table->increments('fuel_id');
            $table->integer('car_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->double('fuelQuantity');
            $table->double('fuelPrice');
            $table->double('fuelValue');

            $table->boolean('isFullFueling');
            $table->integer('lastFullFueling')->unsigned()->nullable();;

            $table->string('slug')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('car_id')->references('car_id')->on('cars');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('lastFullFueling')->references('fuel_id')->on('fuels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuels');
    }
}
