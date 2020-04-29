<?php

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupsDummyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Group::class, 5)->create()
            ->each(function ($group) {
                $group->communities()->attach(2);
            });
    }
}
