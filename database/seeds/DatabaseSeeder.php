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

        factory(\App\Role::class, 1)->create(['name' => 'admin','description' =>'administrador']);
        factory(\App\Role::class, 1)->create(['name' => 'user','description' =>'usuario de la aplicación']);

        factory(\App\User::class, 1)->create([
            'role_id' => \App\Role::ADMIN,
            'name' => 'Jordi Llobet',
	        'email' => 'admin@mail.com',
	        'password' => bcrypt('secret')
        ]);

        factory(\App\User::class, 1)->create([
            'role_id' => \App\Role::USER,
            'name' => 'Joan Pérez',
	        'email' => 'joanperez@mail.com',
	        'password' => bcrypt('secret')
        ]);
    }
}
