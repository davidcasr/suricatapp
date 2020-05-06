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
            'first_name'     => 'User',
            'username'       => 'user',
            'email'          => 'user@test.com',
            'password'       => '123456',
            'remember_token' => str_random(60),
        ]);

        $user->assign('admin');

        $user = User::create([
            'first_name'     => 'MyUser',
            'username'       => 'myuser',
            'email'          => 'myuser@test.com',
            'password'       => '123456',
            'remember_token' => str_random(60),
        ]);

        $user->assign('admin');

        $user = User::create([
            'parent_id'      => 3,
            'first_name'     => 'Supervisor',
            'username'       => 'supervisor',
            'email'          => 'supervisor@test.com',
            'password'       => '123456',
            'remember_token' => str_random(60),
        ]);

        $user->assign('supervisor');

        $user = User::create([
            'parent_id'      => 3,
            'first_name'     => 'Reports',
            'username'       => 'reports',
            'email'          => 'reports@test.com',
            'password'       => '123456',
            'remember_token' => str_random(60),
        ]);

        $user->assign('reports');
    }
}
