<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePictureCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picture_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('title');
            $table->string('description')->nullable();
            $table->integer('max_size')->default(25600);
            $table->string('mimes')->default('jpeg,jpg,gif,png,bmp');
            $table->integer('max_width')->default(640);
            $table->integer('max_height')->default(480);
            $table->integer('min_width')->default(320);
            $table->integer('min_height')->default(240);
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
        Schema::dropIfExists('picture_categories');
    }
}
