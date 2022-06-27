<?php

use Ogilo\AdminMd\Models\Comment;
use Illuminate\Support\Facades\DB;
use Ogilo\AdminMd\Models\CommentUser;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (DB::table('comments')->select('name', 'email', 'website')->distinct()->get() as $comment) {
            $user = new CommentUser;
            $user->name = $comment->name;
            $user->email = $comment->email;
            $user->website = $comment->website;
            $user->save();
        }

        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('comment_users');
        });

        foreach (Comment::all() as $comment) {
            $user = CommentUser::where('email',$comment->email)->first();
            $comment->user_id = $user->id;
            $comment->save();
        }
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_comment_id')->nullable();
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
            $table->string('name')->after('id');
            $table->string('email')->after('name');
            $table->string('website')->after('email')->nullable();
        }); 

        foreach (Comment::with('user')->get() as $comment) {
            $user = $comment->user;
            $comment->name = $user->name;
            $comment->email = $user->email;
            $comment->website = $user->website;
            $comment->save();
        }

        Schema::table('comments',function(Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('parent_comment_id');
        });
    }
}
