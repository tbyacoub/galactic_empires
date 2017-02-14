<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuildingPrototypesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_prototypes', function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('img_path');
            $table->mediumInteger('max_level');

            $table->timestamps();
        });

        Schema::create('building_costs', function (Blueprint $table){
            $table->increments('id');

            $table->mediumInteger('level');
            $table->mediumInteger('mineral');
            $table->mediumInteger('crystal');
            $table->mediumInteger('energy');

            $table->bigInteger('minutes');

            $table->integer('building_prototype_id')->index();
            $table->timestamps();
        });

        Schema::create('resource_buildings', function (Blueprint $table){
            $table->increments('id');

            $table->mediumInteger('level');
            $table->integer('mineral_rate');
            $table->integer('crystal_rate');
            $table->integer('energy_rate');

            $table->integer('building_prototype_id');
            $table->timestamps();
        });

        /*
         * This is the actual buildings table that will be on the individual planets.
         */
        Schema::create('buildings', function (Blueprint $table){
            $table->increments('id');

            $table->mediumInteger('current_level');
            $table->integer('building_prototype_id');
            $table->integer('planet_id')->index();
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
        Schema::dropIfExists('buildings');
        Schema::dropIfExists('resource_buildings');
        Schema::dropIfExists('building_costs');
        Schema::dropIfExists('building_prototypes');

    }
}
