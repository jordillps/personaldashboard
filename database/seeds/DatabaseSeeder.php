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

        //Menus
        factory(\App\Menu::class, 1)->create(['name' => 'breakfast','description' =>'Esmorzar']);
        factory(\App\Menu::class, 1)->create(['name' => 'lunch','description' =>'Dinar']);
        factory(\App\Menu::class, 1)->create(['name' => 'dinner','description' =>'Sopar']);

        //Categories
        factory(\App\Category::class, 1)->create(['name' => 'dish','description' =>'Plat']);
        factory(\App\Category::class, 1)->create(['name' => 'drink','description' =>'Beguda']);
        factory(\App\Category::class, 1)->create(['name' => 'dessert','description' =>'Postre']);

        //Dishes
        factory(App\Dish::class, 20)->create();



        $dishes=App\Dish::where('category_id', 1)->pluck('id')->toArray();
        $drinks=App\Dish::where('category_id', 2)->pluck('id')->toArray();
        $num_drinks = count($drinks);
        $num_menus=App\Menu::count();

        //Insert some dishes in Menus_dishes table
        for ($i = 0; $i < 30; $i++) {
            $k = array_rand($dishes);
            DB::table('dish_menu')->insert([
                'dish_id' => $dishes[$k],
                'menu_id' => rand(1,$num_menus)
            ]);
        }


        //Insert all drinks in Menu_dishes table
        $menu_loop = 1;

        foreach ($drinks as $drink) {
            for ($i = 1; $i <= 3; $i++) {
                DB::table('dish_menu')->insert([
                    'dish_id' => $drink,
                    'menu_id' => $i
                ]);
            }
        }

        //Tables in the restaurant
        factory(App\TableRestaurant::class, 10)->create();

    }
}
