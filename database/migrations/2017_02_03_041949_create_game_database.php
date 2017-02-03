<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SolarSystems', function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->tinyInteger('max_planets');
            $table->json('location');
            $table->timestamps();
        });

        Schema::create('PlanetTypes', function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('type');
            $table->string('img_path');
            $table->timestamps();
        });

        Schema::create('Planets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->float('radius', 10, 2);
            $table->json('resources');
            $table->integer('solarSystem_id')->index();
            $table->integer('planetType_id')->index();
            $table->integer('user_id')->index();
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
        Schema::dropIfExists('Planets');
        Schema::dropIfExists('PlanetTypes');
        Schema::dropIfExists('SolarSystems');
    }
}
