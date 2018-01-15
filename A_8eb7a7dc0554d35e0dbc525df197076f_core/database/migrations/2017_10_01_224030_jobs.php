<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Jobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('city');
            $table->integer('co_id')->unsigned();
            $table->integer('years_experience');
            $table->integer('average_salary');
            $table->integer('gender');
            $table->integer('type_work');
            $table->text('description');
            $table->text('skills');
            $table->integer('views')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();
        });
        
        Schema::create('job_apply', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('job_id');
            $table->integer('status')->default(0);;
            $table->timestamps();
        });
        
        // table
        Schema::table('jobs', function($table) {
            $table->foreign('co_id')->references('id')->on('companie_list')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_apply');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
