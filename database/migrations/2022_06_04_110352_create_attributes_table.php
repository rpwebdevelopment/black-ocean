<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Attribute;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $agility = new Attribute(['name' => 'Agility']);
        $agility->save();

        $smarts = new Attribute(['name' => 'Smarts']);
        $smarts->save();

        $spirit = new Attribute(['name' => 'Spirit']);
        $spirit->save();

        $strength = new Attribute(['name' => 'Strength']);
        $strength->save();

        $vigor = new Attribute(['name' => 'Vigor']);
        $vigor->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
    }
};
