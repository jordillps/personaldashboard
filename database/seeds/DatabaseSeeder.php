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

        factory(\App\User::class, 1)->create([
            'role_id' => \App\Role::ADMIN,
            'name' => 'Jordi Llobet',
            'email' => 'jordillps@gmail.com',
            'birthdate' => new DateTime("1972/09/14"),
	        'password' => bcrypt('Secret00')
        ]);

        factory(\App\User::class, 1)->create([
            'role_id' => \App\Role::USER,
            'name' => 'Joan Pérez',
            'email' => 'joibla.cat@gmail.com',
            'birthdate' => new DateTime("2000/12/14"),
	        'password' => bcrypt('secret')
        ]);

        factory(\App\User::class, 20)->create();
    }
}
