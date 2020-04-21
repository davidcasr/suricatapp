<?php

use Illuminate\Database\Seeder;
use App\Models\Community;

class CommunitiesDummyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $community_1 = Community::create([
            'identification' 	=>'1101',
	        'name' 				=>'Community',
	        'description' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tincidunt lorem non nibh ullamcorper tempus. Proin eget magna id nibh vulputate aliquet. Nullam faucibus purus augue, sed interdum urna euismod non. In suscipit tellus ut nibh cursus pretium. Praesent ultrices sagittis eros aliquam efficitur. Quisque vitae neque felis. Quisque id rhoncus felis. Praesent ut tempus neque, in blandit odio.',
	        'address' 			=> 'Direccion Community',
        ]);

        $community_1->users()->attach(3);

        $community_2 = Community::create([
            'identification' 	=>'1102',
	        'name' 				=>'La comunidad de Davidson',
	        'description' 		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tincidunt lorem non nibh ullamcorper tempus. Proin eget magna id nibh vulputate aliquet. Nullam faucibus purus augue, sed interdum urna euismod non. In suscipit tellus ut nibh cursus pretium. Praesent ultrices sagittis eros aliquam efficitur. Quisque vitae neque felis. Quisque id rhoncus felis. Praesent ut tempus neque, in blandit odio.',
	        'address' 			=> 'Direccion Davidson',
        ]);

        $community_2->users()->attach(3);
    }
}
