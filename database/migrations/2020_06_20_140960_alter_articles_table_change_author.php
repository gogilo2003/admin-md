<?php

use Ogilo\AdminMd\Models\Comment;
use Illuminate\Support\Facades\DB;
use Ogilo\AdminMd\Models\CommentUser;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterarticlesTableChangeAuthor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->json('author')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles',function(Blueprint $table){
            $table->string('author')->change();
        });
    }
}
