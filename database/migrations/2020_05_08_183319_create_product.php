<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug_name');
            $table->float('price');
            $table->float('old_price');
            $table->longText('short_desc');
            $table->string('categorys_ids');
            $table->longText('long_desc');
            $table->string('sall_end');
            $table->string('type');
            $table->boolean('in_slider')->default(false);
            $table->boolean('is_trend')->default(false);
            $table->boolean('is_best_saller')->default(false);
            $table->string('tags');
            $table->integer('stock_size');
            $table->integer('stock_amount');
            $table->integer('thumbnail_id');
            $table->integer('slider_thumbnail_id');
            $table->string('gallery_ids');
            $table->float('tax')->nullable()->default(00.00);
            $table->boolean('state')->nullable()->default(false);
            $table->string('sku', 100)->nullable()->default('');
            $table->boolean('sponsored')->nullable()->default(false);
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
        Schema::dropIfExists('products');
    }
}
