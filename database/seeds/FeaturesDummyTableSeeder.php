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
        $feature_1 = Feature::create([
	        'name' 			=> 'Casado',
	        'description' 	=> 'Casado',
        ]);

        $feature_1->communities()->attach(2);

        $feature_2 = Feature::create([
	        'name' 			=> 'Soltero',
	        'description' 	=> 'Soltero',
        ]);

        $feature_2->communities()->attach(2);

        $feature_3 = Feature::create([
	        'name' 			=> 'Separado',
	        'description' 	=> 'Separado',
        ]);

        $feature_3->communities()->attach(2);

        $feature_4 = Feature::create([
	        'name' 			=> 'Tiene hijos',
	        'description' 	=> 'Tiene hijos',
        ]);

        $feature_4->communities()->attach(2);
    }
}
