<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEventShedulesTableAddEventDayIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_schedules', function ($table) {
            $table->bigInteger('event_day_id')->unsigned()->nullable()->after('event_id');
            $table->foreign('event_day_id')->references('id')->on('event_days')->onDelete('cascade');
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_schedules', function (Blueprint $table) {
            $table->integer('event_id')->unsigned()->nullable()->after('content');
            $table->foreign('event_id')->references('id')->on('events');
            $table->dropForeign(['event_day_id']);
            $table->dropColumn('event_day_id');
        });
    }
}
