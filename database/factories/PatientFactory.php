<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    return [
        'name' => $faker->name($gender = 'male'),
        'age' => $faker->numberBetween(10,100) ,
        'number' => '010'.$faker->randomNumber(8),
        'city' => $faker->city
    ];
});
