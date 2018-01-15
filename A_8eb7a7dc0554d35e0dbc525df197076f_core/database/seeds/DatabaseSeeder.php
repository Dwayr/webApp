<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // companie
        $this->call(companie::class);
        $this->call(companie_team::class);
        $this->call(companie_project::class);
        $this->call(companie_rss::class);
    }
}
