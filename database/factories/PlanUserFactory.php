<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PlanUser;
use Faker\Generator as Faker;

$factory->define(PlanUser::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'plan_id' => $faker->randomDigitNotNull,
        'status' => $faker->randomDigitNotNull,
        'date_activation' => $faker->word,
        'date_deadline' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
