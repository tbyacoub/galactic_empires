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
        Schema::create('solar_systems', function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->tinyInteger('max_planets');
            $table->json('location');
            $table->timestamps();
        });

        Schema::create('planet_types', function (Blueprint $table){
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('type');
            $table->string('img_path');
            $table->timestamps();
        });

        Schema::create('planets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->float('radius', 10, 2);
            //$table->json('resources');
            $table->mediumInteger('metal');
            $table->mediumInteger('energy');
            $table->mediumInteger('wood');
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
        Schema::dropIfExists('planets');
        Schema::dropIfExists('planet_types');
        Schema::dropIfExists('solar_systems');
    }
}
