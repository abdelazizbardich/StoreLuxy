<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->nullable();
            $table->text('slug_name')->nullable();
            $table->longText('content')->nullable();
            $table->string('categorys', 100)->nullable();
            $table->integer('user_id')->unsigned()->nullable()->default(12);
            $table->string('type', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->text('tags')->nullable();
            $table->integer('views')->unsigned()->nullable()->default(1);
            $table->integer('shares')->unsigned()->nullable()->default(1);
            $table->integer('thumbnail')->unsigned()->nullable()->default(0);
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
        Schema::dropIfExists('posts');
    }
}
