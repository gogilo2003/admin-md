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
        try {
            Schema::table('event_days', function (Blueprint $table) {
                $table->dropForeign(['event_id']);
            });
        } catch (\Exception $e) {
            // Foreign key does not exist
        }

        Schema::table('event_days', function (Blueprint $table) {
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
        });

        try {
            Schema::table('event_schedules', function (Blueprint $table) {
                $table->dropForeign(['event_day_id']);
            });
        } catch (\Exception $e) {
            // Foreign key does not exist
        }

        Schema::table('event_schedules', function (Blueprint $table) {
            $table->foreign('event_day_id')
                ->references('id')
                ->on('event_days')
                ->onDelete('cascade');
        });

        try {
            Schema::table('event_schedule_event_speaker', function (Blueprint $table) {
                $table->dropForeign(['event_speaker_id']);
            });
        } catch (\Exception $e) {
            // Foreign key does not exist
        }

        Schema::table('event_schedule_event_speaker', function (Blueprint $table) {
            $table->foreign('event_speaker_id')
                ->references('id')
                ->on('event_speakers')
                ->onDelete('cascade');
        });

        try {
            Schema::table('event_schedule_event_speaker', function (Blueprint $table) {
                $table->dropForeign(['event_schedule_id']);
            });
        } catch (\Exception $e) {
            // Foreign key does not exist
        }
        try {
            Schema::table('event_schedule_event_speaker', function (Blueprint $table) {
                $table->foreign('event_schedule_id')
                    ->references('id')
                    ->on('event_schedules')
                    ->onDelete('cascade');
            });
        } catch (\Exception $e) {
            // Foreign key does not exist
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try {
            Schema::table('event_schedule_event_speaker', function (Blueprint $table) {
                $table->dropForeign(['event_schedule_id']);
            });
        } catch (\Exception $e) {
        }

        try {
            Schema::table('event_schedule_event_speaker', function (Blueprint $table) {
                $table->dropForeign(['event_speaker_id']);
            });
        } catch (\Exception $e) {
        }

        try {
            Schema::table('event_schedules', function (Blueprint $table) {
                $table->dropForeign(['event_day_id']);
            });
        } catch (\Exception $e) {
        }

        try {
            Schema::table('event_days', function (Blueprint $table) {
                $table->dropForeign(['event_id']);
            });
        } catch (\Exception $e) {
        }
    }
}
