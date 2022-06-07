<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ship_id');
            $table->integer('fuel_capacity');
            $table->integer('fuel_current');
            $table->integer('fuel_consumption_weekly');
            $table->integer('fuel_consumption_parsec');
            $table->integer('hardpoints');
            $table->integer('cargo_volume');
            $table->timestamps();

            $table->foreign('ship_id')->references('id')->on('ships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ship_details');
    }
};
