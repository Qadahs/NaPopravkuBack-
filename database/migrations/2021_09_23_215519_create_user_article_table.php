<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_article', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('users_id')->index();
            $table->unsignedBigInteger('articles_id')->index();
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('articles_id')->references('id')->on('articles')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_article');
    }
}
