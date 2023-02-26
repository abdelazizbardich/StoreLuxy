<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->text('file');
            $table->text('alt_title');
            $table->string('name');
            $table->text('slug_name');
            $table->longText('file_desc');
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
        Schema::dropIfExists('Medias');
    }
}
