<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagePictureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('picture');
            $table->text('caption')->nullable();
            $table->boolean('primary')->default(false);
            $table->integer('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('packages');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_pictures');
    }
}
