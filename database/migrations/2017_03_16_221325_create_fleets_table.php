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
            $table->integer('count')->unsigned();
            $table->integer('capacity')->unsigned();
            $table->integer('description_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('planet_id')->unsigned();
            $table->timestamps();

            $table->foreign('planet_id')->references('id')->on('planets')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('description_id')->references('id')->on('descriptions')
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
        Schema::dropIfExists('fleets');
    }
}
