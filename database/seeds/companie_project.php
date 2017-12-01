<?php

use Illuminate\Database\Seeder;

class companie_project extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'owner_id' => 1,
            'title' => 'title co.',
            'icon' => 'icons/path/ic.png',
            'about' => 'about project',
        ]);
    }
}
