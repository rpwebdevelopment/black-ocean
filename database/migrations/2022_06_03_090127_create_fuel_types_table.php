<?php

use App\Models\FuelType;
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
        Schema::create('fuel_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('ppu');
            $table->timestamps();
        });

        $refined = new FuelType([
            'name' => 'Refined',
            'ppu' => 500,
        ]);
        $refined->save();

        $unrefined = new FuelType([
            'name' => 'Unrefined',
            'ppu' => 100,
        ]);
        $unrefined->save();

        $unrefined = new FuelType([
            'name' => 'Free - Self Refined',
            'ppu' => 0,
        ]);
        $unrefined->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuel_types');
    }
};
