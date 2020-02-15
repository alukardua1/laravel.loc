<?php
/**
 * Copyright (c) by anime-free
 * Date: 2020.
 * User: Alukardua
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeStudiosForeignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anime_studios_foreign', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('anime_id');
            $table->unsignedBigInteger('anime_studios_id');
            $table->timestamps();

            $table->foreign('anime_id')->references('id')->on('animes');
            $table->foreign('anime_studios_id')->references('id')->on('anime_studios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime_studios_foreign');
    }
}
