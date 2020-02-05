<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimePeoplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anime_peoples', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('people_id');
            $table->unsignedBigInteger('anime_id');
            $table->timestamps();

            $table->foreign('people_id')->references('id')->on('peoples');
            $table->foreign('anime_id')->references('id')->on('anime_post');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime_peoples');
    }
}
