<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Projects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id');
            $table->string('title');
            $table->string('icon');
            $table->text('about');
            $table->timestamps();
        });
        Schema::create('projects_team', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });
        Schema::create('projects_companie', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('companie_id')->unsigned();
            $table->timestamps();
        });
        // table
        Schema::table('projects_team', function($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('projects_companie', function($table) {
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('companie_id')->references('id')->on('companie_list')->onDelete('cascade');
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
        Schema::dropIfExists('projects');
        Schema::dropIfExists('projects_team');
        Schema::dropIfExists('projects_companie');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        
//        Schema::table('projects_team', function (Blueprint $table) {
//            $table->dropForeign(['project_id']);
//        });
        
    }
}
