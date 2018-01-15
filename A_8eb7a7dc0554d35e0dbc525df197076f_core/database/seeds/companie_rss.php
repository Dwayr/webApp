<?php

use Illuminate\Database\Seeder;

class companie_rss extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companie_rss')->insert([
            'companie_id' => 1,
            'title' => 'title co.',
            'content' => 'content text',
        ]);
    }
}
