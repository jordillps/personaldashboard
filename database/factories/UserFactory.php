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

    // Imatges pel servidor
    //$path = base_path();
    //Personaldasboard:nom carpeta projecte a laragon
    //Images Server: nom carpeta on posem les imatges a Laragon
    //Despres caldrà pujar les imatges a la carpeta del servidor
    //personaldashboard.formalweb.cat/storage/avatars
	//$path = str_replace("personaldashboard", "ImagesServer", $path);

    return [
        'name' => $faker->name,
        'role_id' => \App\Role::USER,
        'email' => $faker->unique()->safeEmail,
        'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'email_verified_at' => now(),
        'password' => bcrypt('secret'), // password
        'remember_token' => Str::random(10),
        //Localhost
        //Necessari storage:link
        //'avatar' => \Faker\Provider\Image::image(storage_path() . '/app/public/avatars', 200, 200, 'people', false),
        //Servidor
        //'avatar' => \Faker\Provider\Image::image($path, 200, 200, 'people', false),
    ];
});
