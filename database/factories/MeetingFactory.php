<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Meeting;
use Faker\Generator as Faker;

$factory->define(Meeting::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'person_id' => $faker->randomDigitNotNull,
        'name' => $faker->word,
        'description' => $faker->text,
        'date' => $faker->word,
        'address' => $faker->word,
        'latitude' => $faker->word,
        'longitude' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
