<?php

use Illuminate\Database\Seeder;

class PeopleDummyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	// attach(2) because is for my test community
        factory(App\Models\Person::class, 50)->create()
         	->each(function ($person) {
                $person->communities()->attach(2);
            });

    }
}
