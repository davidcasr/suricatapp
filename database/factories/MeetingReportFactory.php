<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MeetingReport;
use Faker\Generator as Faker;

$factory->define(MeetingReport::class, function (Faker $faker) {

    return [
        'user_id' => $faker->randomDigitNotNull,
        'person_id' => $faker->randomDigitNotNull,
        'meeting_id' => $faker->randomDigitNotNull,
        'description' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
