<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventScheduleEventSpeakerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('event_schedule_event_speaker')) {
            Schema::create('event_schedule_event_speaker', function (Blueprint $table) {
                $table->id();
                $table->foreignId('event_speaker_id')->constrained('event_speakers')
                    ->onDelete('cascade')
                    ->onUpdate('cascade')
                    ->nullable();

                $table->foreignId('event_schedule_id')->constrained('event_schedules')
                    ->onDelete('cascade')
                    ->onUpdate('cascade')
                    ->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_schedule_event_speaker');
    }
}
