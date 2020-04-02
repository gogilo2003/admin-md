<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPicturesVideosTablesAddFeaturedColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pictures', function ($table) {
            $table->boolean('featured')->default(false);
        });
        Schema::table('videos', function ($table) {
            $table->boolean('featured')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->dropColumn('featured');
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('featured');
        });
    }
}
