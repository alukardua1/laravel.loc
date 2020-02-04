<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anime_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('country_id')->unsigned();
            $table->bigInteger('chanal_id')->unsigned()->default(1);
            $table->string('title')->unique();
            $table->string('url')->unique();
            $table->text('content')->nullable();
            $table->text('xfield')->nullable();
            $table->string('description');
            $table->string('metatitle');
            $table->text('keywords');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('chanal_id')->references('id')->on('chanals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime_posts');
    }
}
