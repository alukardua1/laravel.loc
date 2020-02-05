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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('chanal_id')->default(1);
            $table->string('title')->unique();
            $table->string('url')->unique();
            $table->string('poster')->nullable();
            $table->text('content')->nullable();
            $table->string('description');
            $table->string('metatitle');
            $table->text('keywords');
            $table->string('wa_id')->nullable();
            $table->string('shikimori_id')->nullable();
            $table->string('kp_id')->nullable();
            $table->string('mal_id')->nullable();
            $table->string('anidb_id')->nullable();
            $table->string('kind');
            $table->string('released');
            $table->string('japanese')->nullable();
            $table->string('english')->nullable();
            $table->string('romaji')->nullable();
            $table->string('aired_season')->nullable();
            $table->Time('delivery_time')->nullable();
            $table->string('canal')->nullable();
            $table->string('count_series')->nullable();
            $table->string('duration')->nullable();
            $table->date('aired_on')->nullable();
            $table->date('released_on')->nullable();
            $table->string('rating')->nullable();
            $table->string('video')->nullable();
            $table->string('tip')->nullable();

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
