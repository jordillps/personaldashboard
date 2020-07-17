<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dish;
use Faker\Generator as Faker;

$factory->define(Dish::class, function (Faker $faker) {


    $array_categories = [1,2];
    $k = array_rand($array_categories);
    $categoryid = $array_categories[$k];
    if($categoryid == 1){
        $urlimage = 'dishes/dish-'.rand(1, 10).'.jpeg';
    }else{
        $urlimage = 'drinks/drink-'.rand(1, 10).'.jfif';
    }
    return [
        'category_id' => $categoryid,
        'title' => $faker->sentence($nbWords = 3, $variableNbWords = true) ,
        'description' => $faker->paragraph($nbSentences = 2, $variableNbSentences = true),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 2, $max = 30),
        //Localhost
        //'photo' => $faker->image(storage_path() . '/app/public/dishes', 1000, 611, 'food', false),
        'photo' => $urlimage,
    ];
});
