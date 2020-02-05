<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('parent_comment_id')->default(0);
            $table->unsignedBigInteger('repent_user_id')->default(0);
            $table->text('content');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('post_id')->references('id')->on('anime_posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
