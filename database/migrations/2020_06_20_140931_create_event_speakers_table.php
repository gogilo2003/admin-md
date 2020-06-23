<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_speakers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('name');
            $table->date('photo')->nullable();
            $table->date('description')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->integer('event_id')->nullable();
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_speakers', function (Blueprint $table) {
            Schema::dropIfExists('event_speakers');
        });
    }
}
