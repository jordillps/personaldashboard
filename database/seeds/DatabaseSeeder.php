<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        Storage::deleteDirectory('avatars');

        Storage::makeDirectory('avatars');

        factory(\App\Role::class, 1)->create(['name' => 'admin','description' =>'administrador']);
        factory(\App\Role::class, 1)->create(['name' => 'user','description' =>'usuario de la aplicación']);



        factory(\App\User::class, 20)->create();
    }
}
