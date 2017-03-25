<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFleetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('planet_id')->unsigned();
            $table->integer('description_id')->unsigned();
            $table->string('type'); //Fighter, Bomber, Corvette, Frigate, Destroyer
            $table->json('multipliers');
            $table->integer('speed');
            $table->integer('health');
            $table->integer('attack');
            $table->integer('defence');
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
        Schema::dropIfExists('fleets');
    }
}
