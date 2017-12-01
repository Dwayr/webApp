<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanieTeam extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companie_team', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('companie_id');
            $table->string('user_public_code', 55);
            $table->string('user_position', 55);
            $table->date('work_start_history');
            $table->date('work_end_history');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('companie_team');
    }
}
