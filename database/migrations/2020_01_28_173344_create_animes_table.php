<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('country_id');
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
            $table->string('released');
            $table->string('japanese')->nullable();
            $table->string('english')->nullable();
            $table->string('romaji')->nullable();
            $table->string('aired_season')->nullable();
            $table->Time('delivery_time')->nullable();
            $table->string('tv_canal')->nullable();
            $table->string('count_series')->nullable();
            $table->string('current_series')->nullable();
            $table->string('duration')->nullable();
            $table->date('aired_on')->nullable();
            $table->date('released_on')->nullable();
            $table->string('rating')->nullable();
            $table->string('video')->nullable();
            $table->string('tip')->nullable();
            $table->string('posted_at')->default(1);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animes');
    }
}
