<?php

namespace App\Http\Controllers;
use App\Charts\UsersChart;
use App\User;

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

        $today_users = User::whereDate('created_at', today())->count();
        $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();

        $userschart = new UsersChart;
        $userschart->labels(['One', 'Two', 'Three','Four']);
        $userschart->dataset('My dataset', 'line', [1, 2, 3, 4]);
        $userschart->dataset('My dataset 2', 'line', [4, 3, 2, 1]);
        return view('charts');
    }
}
