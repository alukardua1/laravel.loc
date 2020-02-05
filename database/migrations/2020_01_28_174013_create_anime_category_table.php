<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anime_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('anime_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('anime_id')->references('id')->on('animes');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anime_category');
    }
}
