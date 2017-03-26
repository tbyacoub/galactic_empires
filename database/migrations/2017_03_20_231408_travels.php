<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Travels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->integer('from_planet_id');
            $table->integer('to_planet_id');
            $table->json('fleet');
            $table->integer('metal')->default(0);
            $table->integer('energy')->default(0);
            $table->integer('crystal')->default(0);
            $table->dateTime('departure');
            $table->dateTime('arrival');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travels');
    }
}
