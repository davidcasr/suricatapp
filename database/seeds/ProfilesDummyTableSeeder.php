<?php

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfilesDummyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Profile::class, 25)->create()
            ->each(function ($profile) {
                $profile->communities()->attach(2);
            });
    }
}
