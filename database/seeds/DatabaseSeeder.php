<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(UsersTableSeeder::class);
        $this->call(GenGroupTableSeeder::class);
        $this->call(GenListTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PlansTableSeeder::class);
        
        // Dummy Data 
        // $this->call(UsersDummyTableSeeder::class);
        // $this->call(PlanUsersDummyTableSeeder::class);
        // $this->call(CommunitiesDummyTableSeeder::class);
        // $this->call(FeaturesDummyTableSeeder::class);
        // $this->call(PeopleDummyTableSeeder::class);
    }
}
