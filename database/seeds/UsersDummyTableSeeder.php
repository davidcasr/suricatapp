<?php

use Illuminate\Database\Seeder;

class UsersDummyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username'       => 'juliantorres',
            'email'          => 'juliantorres@gmail.com',
            'password'       => 'dacasr90',
            'remember_token' => str_random(60),
        ]);

        $user->assign('admin');
    }
}
