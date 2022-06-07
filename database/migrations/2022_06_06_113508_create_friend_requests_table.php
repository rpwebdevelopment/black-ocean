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
        Schema::create('friend_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requested_by_user_id');
            $table->unsignedBigInteger('for_user_id');
            $table->boolean('accepted')->default(false);
            $table->boolean('rejected')->default(false);
            $table->timestamps();

            $table->foreign('requested_by_user_id')->references('id')->on('users');
            $table->foreign('for_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friend_requests');
    }
};
