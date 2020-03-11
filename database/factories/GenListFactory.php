<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\GenList;
use Faker\Generator as Faker;

$factory->define(GenList::class, function (Faker $faker) {

    return [
        'item_id' => $faker->randomDigitNotNull,
        'item_description' => $faker->word,
        'item_cod' => $faker->word,
        'enabled' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
