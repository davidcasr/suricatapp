<?php

use Illuminate\Database\Seeder;
use App\Models\PlanUser;
use Carbon\Carbon;

class PlanUsersDummyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// User Dummy 
        $plan_users = PlanUser::create([
            'user_id'     		=> 2,
            'plan_id'      		=> 1,
            'status'       		=> 1,
            'date_activation'   => Carbon::now(),
            'date_deadline'     => Carbon::now()->addYear(),
        ]);

        // User Dummy Personal
        $plan_users = PlanUser::create([
            'user_id'     		=> 3,
            'plan_id'      		=> 2,
            'status'       		=> 1,
            'date_activation'   => Carbon::now(),
            'date_deadline'     => Carbon::now()->addYear(),
        ]);
    }
}
