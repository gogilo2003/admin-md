<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('event_schedules')){
            Schema::create('event_schedules', function (Blueprint $table) {
                Schema::disableForeignKeyConstraints();
                $table->increments('id');
                $table->time('start_at');
                $table->time('end_at');
                $table->string('title');
                $table->text('content')->nullable();
                $table->bigInteger('event_day_id')->unsigned();
                $table->foreign('event_day_id')->references('id')->on('event_days');
                $table->boolean('published')->default(false);
                $table->timestamps();
                Schema::enableForeignKeyConstraints();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('event_schedules');
        Schema::enableForeignKeyConstraints();
    }
}
