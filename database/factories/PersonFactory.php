<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {

    return [
        'identification' => $faker->ein,
        'first_name' => $faker->firstName($gender = null),
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'sex' => $faker->numberBetween($min = 1, $max = 2),
        'address' => $faker->address,
        'birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'city' => $faker->city,
        'country' => 170,
        'phone' => $faker->phoneNumber,
        'photo' => $faker->word,
        'created_at' => $faker->dateTimeThisYear($max = 'now'),
        'updated_at' => $faker->dateTimeThisYear($max = 'now')
    ];
});