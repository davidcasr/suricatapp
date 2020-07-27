<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
        	['id'=>1,'identification'=>'family','name'=>'Family','price'=>'0','q_users'=>100,'q_administrators'=>1,'q_communities'=>1],
            ['id'=>2,'identification'=>'community','name'=>'Community','price'=>'25','q_users'=>1000,'q_administrators'=>50,'q_communities'=>2],
            ['id'=>3,'identification'=>'pro','name'=>'Pro','price'=>'150','q_users'=>5000,'q_administrators'=>100,'q_communities'=>16],
        ]);
    }
}
