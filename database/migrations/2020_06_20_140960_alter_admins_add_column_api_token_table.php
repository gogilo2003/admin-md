<?php

use Ogilo\AdminMd\Models\Comment;
use Illuminate\Support\Facades\DB;
use Ogilo\AdminMd\Models\CommentUser;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAdminsTableAddColumnApiToken extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('admins', function (Blueprint $table) {
            $table->string('api_token')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins',function(Blueprint $table){
            $table->dropForeign(['api_token']);
        });
    }
}
