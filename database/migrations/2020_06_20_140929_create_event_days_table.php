<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('day');
            $table->string('title');
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
        Schema::table('event_days', function (Blueprint $table) {
            Schema::dropIfExists('event_days');
        });
    }
}
