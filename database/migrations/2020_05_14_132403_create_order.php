<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 100)->nullable()->default('text');
            $table->string('last_name', 100)->nullable()->default('text');
            $table->string('phone', 100)->nullable()->default('text');
            $table->string('city', 100)->nullable()->default('text');
            $table->text('adress')->nullable()->default('text');
            $table->float('total_cart')->nullable()->default(0.00);
            $table->float('shipping_cost')->nullable()->default(0.00);
            $table->float('tax_cost')->nullable()->default(0.00);
            $table->float('total_order')->nullable()->default(0.00);
            $table->string('code', 100)->nullable()->default('text');
            $table->integer('carts_ids')->unsigned()->nullable()->default(0);
            $table->text('note')->nullable()->default('text');
            $table->integer('state')->unsigned()->nullable()->default(0);
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
        Schema::dropIfExists('orders');
    }
}
