<?php

namespace App\Http\Controllers;
use App\Charts\UsersChart;
use App\User;
use App\Providers\ChartsServiceProvider;

use Illuminate\Http\Request;

class ChartsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $old_users = User::whereDate('birthdate', '<=', '1990-01-01')
                            ->count();
        $young_users = User::whereDate('birthdate', '>', '1990-01-01')
                             ->whereDate('birthdate', '<=', '2000-01-01')
                             ->count();
        $youngest_users = User::whereDate('birthdate', '>', '2000-01-01')
                            ->count();
        $userschart = new UsersChart;
        $userschart->labels(['Old', 'Young', 'Youngest']);
        $userschart->dataset('My dataset', 'bar', [$old_users, $young_users, $youngest_users]);
        $userschart->title("Users Age");

        return view('charts', compact('userschart'));
    }
}
