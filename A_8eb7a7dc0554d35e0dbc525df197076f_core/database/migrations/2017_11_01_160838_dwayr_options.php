<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DwayrOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dwayr_options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('options_parent')->default(0);
            $table->string('options_collection');
            $table->string('options_prefix');
            $table->string('options_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dwayr_options');
    }
}
