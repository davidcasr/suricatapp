<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Plan;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker) {

    return [
        'identification' => $faker->word,
        'name' => $faker->word,
        'price' => $faker->word,
        'q_users' => $faker->randomDigitNotNull,
        'q_administrators' => $faker->randomDigitNotNull,
        'q_communities' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
