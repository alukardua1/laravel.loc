<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeTranslateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anime_translate', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('anime_id');
            $table->unsignedBigInteger('translate_id');
            $table->timestamps();

            $table->foreign('anime_id')->references('id')->on('animes');
            $table->foreign('translate_id')->references('id')->on('translaters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime_translate');
    }
}
