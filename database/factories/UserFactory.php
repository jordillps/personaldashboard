<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {

    //Servidor
    //$path = base_path();
    //Personaldasboard:nom carpeta projecte
    //httpdocs: nom carpeta on posem el directori public servidor
	//$path = str_replace("personaldashboard", "httpdocs", $path);

    return [
        'name' => $faker->name,
        'role_id' => \App\Role::USER,
        'email' => $faker->unique()->safeEmail,
        'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'email_verified_at' => now(),
        'password' => bcrypt('secret'), // password
        'remember_token' => Str::random(10),
        //Localhost
        'avatar' => \Faker\Provider\Image::image(storage_path() . '/app/public/avatars', 200, 200, 'people', false),
        //Servidor
        //'avatar' => \Faker\Provider\Image::image($path . '/storage/avatars', 200, 200, 'people', false),
    ];
});
