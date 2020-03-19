<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //AQUEST ARXIU NO ES A GITHUB
        //
        factory(\App\User::class, 1)->create([
            'role_id' => \App\Role::ADMIN,
            'name' => 'Jordi Pérez',
            'email' => 'jordiperez@mail.com',
            'birthdate' => new DateTime("1972/09/14"),
            'password' => bcrypt('Secret00'),
            'googlecalendarid'=>'jordillps@gmail.com',
            'googlecalendarapikey' => 'AIzaSyA9bjFJ0uPe8RAOgL3Bdb5PuoEQhgeTyPM'
        ]);

        factory(\App\User::class, 1)->create([
            'role_id' => \App\Role::USER,
            'name' => 'Joan Pérez',
            'email' => 'joanperez@mail.com',
            'birthdate' => new DateTime("2000/12/14"),
	        'password' => bcrypt('secret')
        ]);
    }
}
