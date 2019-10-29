<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterPackagePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::disableForeignKeyConstraints();

        Schema::table('package_page',function(Blueprint $table){
            $table->dropForeign(['package_id']);
            $table->dropForeign(['page_id']);
        });

        Schema::rename('package_page', 'package_category_page');

        Schema::table('package_category_page', function (Blueprint $table) {
            $table->foreign('page_id')->references('id')->on('pages');
            $table->integer('package_category_id')->unsigned()->default(1)->after('page_id');
            $table->foreign('package_category_id')->references('id')->on('package_categories');
        });

        Schema::table('package_category_page', function (Blueprint $table) {
            $table->integer('package_id')->nullable()->change();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::disableForeignKeyConstraints();

        Schema::table('package_category_page', function (Blueprint $table) {
            $table->dropForeign(['page_id']);
            $table->dropForeign(['package_category_id']);
            $table->dropColumn('package_category_id');
        });

        Schema::rename('package_category_page','package_page');

        Schema::table('package_page', function (Blueprint $table) {
            $table->integer('package_id')->unsigned()->change();
            $table->foreign('package_id')->references('id')->on('packages');
            $table->foreign('page_id')->references('id')->on('pages');
        });

        Schema::enableForeignKeyConstraints();
    }
}
