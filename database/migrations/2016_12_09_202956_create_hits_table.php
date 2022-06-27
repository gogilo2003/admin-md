<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip')->nullable();
            $table->string('url')->nullable();
            $table->string('method')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('language')->nullable();
            $table->boolean('wants_json')->nullable();
            $table->boolean('is_json')->nullable();
            $table->boolean('ajax')->nullable();
            $table->boolean('pjax')->nullable();
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
        Schema::dropIfExists('hits');
    }
}
