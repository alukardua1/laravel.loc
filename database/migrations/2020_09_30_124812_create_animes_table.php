<?php
/******************************************************************************
 * Copyright (c) by anime-free                                                *
 * Date: 2020.                                                                *
 * Author: Alukard                                                            *
 ******************************************************************************/

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
            $table->id();
            $table->foreignId('user_id');
            $table->string('metatitle');
            $table->text('keywords');
            $table->string('name');
            $table->string('russian');
            $table->string('original_img')->nullable();
            $table->string('preview_img')->nullable();
            $table->string('url');
            $table->foreignId('kind');
            $table->string('status');
            $table->string('broadcast')->nullable();
            $table->integer('episodes')->default(0);
            $table->integer('episodes_aired')->default(0);
            $table->string('aired_season')->nullable();
            $table->date('aired_on')->nullable();
            $table->date('released_on')->nullable();
            $table->string('rating')->nullable();
            $table->text('english')->nullable();
            $table->text('japanese')->nullable();
            $table->text('synonyms')->nullable();
            $table->string('license_name_ru')->nullable();
            $table->integer('duration')->default(0);
            $table->text('description')->nullable();
            $table->text('description_html')->nullable();
            $table->text('description_source')->nullable();
            $table->string('franchise')->nullable();
            $table->boolean('anons')->default(0);
            $table->boolean('ongoing')->default(0);
            $table->boolean('blocking')->default(0);
            $table->string('region')->nullable();
            $table->string('player')->nullable();
            $table->text('treyler')->nullable();
            $table->boolean('posted_at')->default(1);
            $table->boolean('comment_at')->default(1);
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
        Schema::dropIfExists('animes');
    }
}
