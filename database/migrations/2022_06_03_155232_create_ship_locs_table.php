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
        Schema::create('ship_locs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ship_id');
            $table->integer('current_lat');
            $table->integer('current_long');
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
        Schema::dropIfExists('ship_locs');
    }
};
