<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeStudioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anime_studio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anime_id');
            $table->foreignId('studio_id');
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
        Schema::dropIfExists('anime_studio');
    }
}
