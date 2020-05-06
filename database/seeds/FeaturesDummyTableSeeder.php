<?php

use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeaturesDummyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Models\Feature::class, 5)->create()
            ->each(function ($feature) {
                $feature->communities()->attach(2);
            });
    }
}
