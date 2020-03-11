<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\GenGroup;
use Faker\Generator as Faker;

$factory->define(Gen_Group::class, function (Faker $faker) {

    return [
        'group_cod' => $faker->word,
        'group_description' => $faker->word,
        'enabled' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
