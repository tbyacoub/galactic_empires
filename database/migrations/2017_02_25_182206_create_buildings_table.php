<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->unique();
            $table->string('description')->nullable();
            $table->string('type');
            $table->string('img_path');
            $table->timestamps();
        });

        Schema::create('building_planet', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('building_id')->unsigned();
            $table->integer('planet_id')->unsigned();
            $table->mediumInteger('current_level');
            //$table->tinyInteger('upgrading');

            $table->foreign('planet_id')->references('id')->on('planets')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('building_id')->references('id')->on('buildings')
                ->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('building_planet');
        Schema::drop('buildings');
    }
}
