<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterArticlesTableChangeAuthor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('articles', 'author')) {
            Schema::table('articles', function (Blueprint $table) {
                $table->dropColumn('author');
            });
        }
        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->after('title')->nullable();
            $table->foreign('author_id')->references('id')->on('authors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');

            if (!Schema::hasColumn('articles', 'author')) {
                Schema::table('articles', function (Blueprint $table) {
                    $table->string('author')->nullable();
                });
            }
        });
    }
}
