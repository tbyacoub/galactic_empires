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
            $table->double('rate_metal', 3, 1)->unsigned();
            $table->double('rate_crystal', 3, 1)->unsigned();
            $table->double('rate_energy', 3, 1)->unsigned();
            $table->integer('base_minutes')->unsigned();
            $table->double('rate_minutes', 3, 1)->unsigned();
            $table->integer('upgradeable_id')->unsigned();
            $table->string('upgradeable_type');
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
