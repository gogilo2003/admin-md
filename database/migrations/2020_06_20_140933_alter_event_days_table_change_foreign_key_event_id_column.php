<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEventDaysTableChangeForeignKeyEventIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_days', function ($table) {
            $table->dropForeign(['event_id']);
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
        Schema::table('event_schedules', function ($table) {
            $table->dropForeign(['event_day_id']);
            $table->foreign('event_day_id')->references('id')->on('event_days')->onDelete('cascade');
        });
        Schema::table('event_schedule_event_speaker', function ($table) {
            $table->dropForeign(['event_speaker_id']);
            $table->foreign('event_speaker_id')->references('id')->on('event_speakers')->onDelete('cascade');
            $table->dropForeign(['event_schedule_id']);
            $table->foreign('event_schedule_id')->references('id')->on('event_schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_days', function (Blueprint $table) {
            // $table->dropColumn('event_id');
        });
    }
}
