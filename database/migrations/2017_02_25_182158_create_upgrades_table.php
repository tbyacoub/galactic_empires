<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpgradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upgrades', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumInteger('max_level');
            $table->integer('base_metal')->unsigned();
            $table->integer('base_crystal')->unsigned();
            $table->integer('base_energy')->unsigned();
            $table->integer('rate_metal')->unsigned();
            $table->integer('rate_crystal')->unsigned();
            $table->integer('rate_energy')->unsigned();
            $table->integer('minutes')->unsigned();
            $table->integer('upgradable_id')->unsigned();
            $table->string('upgradable_type');
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
        Schema::dropIfExists('upgrades');
    }
}
