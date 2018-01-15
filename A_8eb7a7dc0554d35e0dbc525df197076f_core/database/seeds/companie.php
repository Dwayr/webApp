<?php

use Illuminate\Database\Seeder;

class companie extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companie_list')->insert([
            'owner_id' => 1,
            'name' => 'title',
            'url' => 'soft',
            'logo' => 'default.png',
            'site' => 'gmail.com',
            'specialization' => 'specialization',
            'headquarters' => 'headquarters',
            'establishment' => 'establishment',
            'about' => 'about',
        ]);
    }
}
