<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSermonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sermons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('title')->unique();
            $table->string('picture')->nullable();
            $table->string('audio')->nullable();
            $table->string('video')->nullable();
            $table->longText('content')->nullable();
            $table->string('sermon_by')->nullable();
            $table->dateTime('sermon_at')->nullable();
            $table->boolean('published')->default(false);
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
        Schema::dropIfExists('sermons');
    }
}
