<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'first_name'      => 'David',
            'last_name'       => 'Castro',
            'username'       => 'admin',
            'email'          => 'david.castroruiz@gmail.com',
            'password'       => 'dacasr90',
            'remember_token' => str_random(60),
        ]);

        $user->assign('super');
    }
}
