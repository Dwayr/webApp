<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenerateCv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generate_cv', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname');
            $table->string('dateBirth');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('githublink');
            $table->string('linkedinlink');
            $table->string('skills');
            $table->string('attachment');
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
        Schema::dropIfExists('generate_cv');
    }
}
