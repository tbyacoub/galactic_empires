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
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('planet_id')->unsigned();
            $table->integer('description_id')->unsigned();
            $table->integer('upgrade_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->mediumInteger('current_level');
            $table->boolean('is_upgrading');
            $table->timestamps();

            $table->foreign('planet_id')->references('id')->on('planets')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('description_id')->references('id')->on('descriptions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('upgrade_id')->references('id')->on('upgrades')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')
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
        Schema::dropIfExists('buildings');
    }
}
