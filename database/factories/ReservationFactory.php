<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Reservation;
use Illuminate\Support\Arr;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {

    $NewReservation = New Reservation();
    $slot = Arr::random($NewReservation->enumSlots);
    $reservation_date = $faker->dateTimeBetween('now', '+1 month');
    $date = $reservation_date->format('Y-m-d');
    $start = $date." ".substr($slot, 0, 5).":00";
    $end = $date." ".substr($slot, 6, 5).":00";
    return [

        //
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->randomNumber($nbDigits = 9, $strict = false),
        'reservation_date' => $reservation_date,
        'slot' => $slot,
        'start'=> $start,
        'end' => $end,
    ];
});
