<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('article_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            try {
                $table->foreign('article_id')
                    ->references('id')
                    ->on('articles')
                    ->onDelete('cascade');
            } catch (Throwable $th) {
                // throw th
            }

            try {
                $table->foreign('tag_id')
                    ->references('id')
                    ->on('tags')
                    ->onDelete('cascade');
            } catch (Throwable $th) {
                //throw $th;
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tag');
    }
}
