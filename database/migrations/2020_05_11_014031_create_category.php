<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->nullable()->default('text');
            $table->string('slug_name', 100)->nullable()->default('text');
            $table->text('car_desc')->nullable()->default('text');
            $table->string('type', 100)->nullable()->default('text');
            $table->Integer('thumbnail')->nullable()->default(0);
            $table->integer('parent')->unsigned()->nullable()->default(0);
            $table->boolean('in_home')->nullable()->default(false);
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
        Schema::dropIfExists('categorys');
    }
}
