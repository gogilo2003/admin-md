<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAlterCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach(DB::table('comments')->select('name','email','website')->distinct()->get() as $comment){
            
        }

        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('comment_users');
            $table->unsignedBigInteger('parent_comment_id')->nullable();
            $table->foreign('parent_comment_id')->references('id')->on('comments');
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('website');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments',function(Blueprint $table){
            $table->string('name');
            $table->string('email');
            $table->string('website')->nullable();
            $table->dropIndex('user_id');
            $table->dropColumn('user_id');
            $table->dropIndex('parent_comment_id');
            $table->dropColumn('parent_comment_id');
        });
    }
}
