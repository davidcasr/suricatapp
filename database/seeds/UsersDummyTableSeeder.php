<?php

use Illuminate\Database\Seeder;
use App\User;

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

        $user = User::create([
            'username'       => 'ingdavidcasr',
            'email'          => 'ingdavidcasr@gmail.com',
            'password'       => 'dacasr90',
            'remember_token' => str_random(60),
        ]);

        $user->assign('admin');
    }
}
