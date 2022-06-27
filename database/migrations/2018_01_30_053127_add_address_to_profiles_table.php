<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('box_no')
                  ->after('email')
                  ->nullable();
            $table->string('post_code')
                  ->after('box_no')
                  ->nullable();
            $table->string('town')
                  ->after('post_code')
                  ->nullable();
            $table->text('address')
                  ->after('town')
                  ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('town');
            $table->dropColumn('post_code');
            $table->dropColumn('box_no');
        });
    }
}
