<?php

use Illuminate\Database\Seeder;

class companie_team extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companie_team')->insert([
            'companie_id' => 1,
            'user_public_code' => '3wFDZtJdQt6ZgpSS',
            'user_position' => 'web',
        ]);
    }
}
