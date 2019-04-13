<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterHitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hits', function (Blueprint $table) {
            if(!Schema::hasColumn('hits', 'browser')){
                $table->string('browser')->nullable()->after('user_agent');
            }
            if(!Schema::hasColumn('hits', 'platform')){
                $table->string('platform')->nullable()->after('browser');
            }
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hits', function (Blueprint $table) {
            $table->dropColumn(['browser', 'platform']);
        });
    }
}
