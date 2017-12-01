<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanieList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companie_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id');
            $table->string('name', 55);
            $table->string('url', 55);
            $table->string('logo', 55);
            $table->string('site',55);
            $table->string('email',55)->default('info@example.com');
            $table->string('specialization');
            $table->string('headquarters');
            $table->string('establishment');
            $table->text('about');
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
        Schema::dropIfExists('companie_list');
    }
}
