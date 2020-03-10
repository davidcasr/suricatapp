<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Assistant;
use Faker\Generator as Faker;

$factory->define(Assistant::class, function (Faker $faker) {

    return [
        'person_id' => $faker->randomDigitNotNull,
        'group_id' => $faker->randomDigitNotNull,
        'meeting_id' => $faker->randomDigitNotNull,
        'confirmation' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
