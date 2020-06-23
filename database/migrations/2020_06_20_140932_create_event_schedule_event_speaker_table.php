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
        Schema::table('event_schedule_event_speaker', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('event_speaker_id')->nullable();
            $table->foreign('event_speaker_id')->references('id')->on('event_speakers');
            $table->integer('event_sschedule_id')->nullable();
            $table->foreign('event_sschedule_id')->references('id')->on('event_sschedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_schedule_event_speaker', function (Blueprint $table) {
            Schema::dropIfExists('event_schedule_event_speaker');
        });
    }
}
