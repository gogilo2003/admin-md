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
            $table->foreign('event_day_id')->references('id')->on('event_days');
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
            $table->dropColumn('event_day_id');
        });
    }
}
