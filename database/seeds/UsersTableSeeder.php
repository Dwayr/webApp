<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'public_code' => '3wFDZtJdQt6ZgpSS',
            'username' => 'komicho',
            'first_name' => 'komicho',
            'last_name' => 'komicho',
            'email' => str_random(10).'@gmail.com',
            'avatar' => 'avatar.com',
            'password' => md5('$#?/?%&$123'),
            'country_code' => 'EG',
            'about' => 'about',
        ]);
    }
}
