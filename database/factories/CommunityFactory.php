<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Community;
use Faker\Generator as Faker;

$factory->define(Community::class, function (Faker $faker) {

    return [
        'identification' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'description' => $faker->word,
        'address' => $faker->word,
        'latitude' => $faker->word,
        'longitude' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
