<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->unique();
            $table->string('description')->nullable();
            $table->string('type');
            $table->string('img_path');
            $table->timestamps();
        });

        Schema::create('describables', function (Blueprint $table) {
            $table->integer('description_id')->unsigned();
            $table->morphs('describable');

            $table->foreign('description_id')->references('id')->on('descriptions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->index(['description_id', 'describable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('describables');
        Schema::dropIfExists('descriptions');
    }
}
