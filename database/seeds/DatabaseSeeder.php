<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        Storage::deleteDirectory('avatars');

        Storage::makeDirectory('avatars');

        factory(\App\Role::class, 1)->create(['name' => 'admin','description' =>'administrador']);
        factory(\App\Role::class, 1)->create(['name' => 'user','description' =>'usuario de la aplicación']);

        //$this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Jordi Administrador',
            'role_id' => \App\Role::ADMIN,
            'email' => 'jordiadministrador@mail.com',
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),

        ]);

        DB::table('users')->insert([
            'name' => 'Administrador',
            'role_id' => \App\Role::ADMIN,
            'email' => 'admin@mail.com',
            'password' => bcrypt('Secret00'),
            'remember_token' => Str::random(10),

        ]);

        //Users
        factory(\App\User::class, 20)->create();

        //Reservations
        factory(App\Reservation::class, 10)->create();
    }
}
