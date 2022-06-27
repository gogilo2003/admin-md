<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPictureCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('picture_categories', function (Blueprint $table) {
            $table->integer('max_width')->default(null)->nullable()->change();
            $table->integer('max_height')->default(null)->nullable()->change();
            $table->integer('min_width')->default(null)->nullable()->change();
            $table->integer('min_height')->default(null)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pricture_categories', function (Blueprint $table) {
            //
        });
    }
}
