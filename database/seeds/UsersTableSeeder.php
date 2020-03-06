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
    	$user = User::create([
            'firstname'      => 'David',
            'lastname'       => 'Castro',
            'username'       => 'admin',
            'email'          => 'david.castroruiz@gmail.com',
            'password'       => 'dacasr90',
            'remember_token' => str_random(60),
        ]);

        $user->assign('super');
    }
}
