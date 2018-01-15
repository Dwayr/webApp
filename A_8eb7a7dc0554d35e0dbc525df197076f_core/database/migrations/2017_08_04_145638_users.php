<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('public_code');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('email');
            $table->string('avatar');
            $table->string('password');
            $table->string('country_code',2);
            $table->string('about',500);
            $table->integer('user_verify')->default(0);
            $table->integer('is_activated')->default(0);
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
