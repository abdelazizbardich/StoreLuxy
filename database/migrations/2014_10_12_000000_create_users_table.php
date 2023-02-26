<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 100)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('first_name', 100)->nullable()->default('');
            $table->string('last_name', 100)->nullable()->default('');
            $table->string('gender', 100)->nullable()->default('male');
            $table->text('adress')->nullable()->default('');
            $table->string('zip', 100)->nullable()->default('00000');
            $table->integer('age')->unsigned()->nullable()->default(0);
            $table->text('password')->nullable()->default('');
            $table->integer('role')->unsigned()->nullable()->default(0);
            $table->integer('avatar')->unsigned()->nullable()->default(0);
            $table->boolean('state')->nullable()->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
