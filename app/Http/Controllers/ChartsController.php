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
        $userschartbar = new UsersChart;
        $userschartbar->labels(['>30', '30-20', '<20']);
        $userschartbar->dataset('Number of users', 'bar', [$old_users, $young_users, $youngest_users]);
        $userschartbar->options([
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ],
            'elements'=>[
                'rectangle'=>[
                    'borderWidth' => 3,
                    'backgroundColor'=> 'rgb(0, 255, 0, 0.1)',
                    'borderColor' => 'rgb(0, 255, 0)',
                    'borderSkipped' => 'bottom'
                ]
            ],
            'responsive' => true,
            'title'=> [
                'display' => true,
                'text' => 'User Age'
            ],
            'scales'=> [
                'xAxes'=> [
                    'barPercentage'=> 0.5,
                    'barThickness'=> 3,
                    'maxBarThickness'=> 8,
                    'minBarLength'=> 2,
                    'gridLines'=> [
                        'offsetGridLines'=> true
                    ]
                ]
            ]
        ]);

        $userschartdoughnut = new UsersChart;
        $userschartdoughnut->labels(['>30', '30-20', '<20']);
        $userschartdoughnut->dataset('Number of users', 'doughnut', [$old_users, $young_users, $youngest_users])->options([
            'backgroundColor' => ["#3e95cd","#8e5ea2","#3cba9f"],
            'borderColor'=>'gray',
            'boderWith'=> 1
        ]);



        return view('charts', compact('userschartbar','userschartdoughnut'));
    }
}
