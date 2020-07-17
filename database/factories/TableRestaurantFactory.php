<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TableRestaurant;
use Faker\Generator as Faker;

$factory->define(TableRestaurant::class, function (Faker $faker) {
    return [
        //
        'capacity' => $faker->randomDigitNot(7,9),
	    'description' => $faker->sentence,
    ];
});
