<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Create the Posts table.
         */
        Schema::create('posts', function (Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('content');
            $table->string('post_date');
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
        /**
         * Drop these tables if they exist.
         */
        Schema::dropIfExists('posts');
    }
}
