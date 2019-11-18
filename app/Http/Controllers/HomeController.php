<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        //$users = User::with('role')->get();
        //return view('home',compact('users'));
        return view('home');
    }


    public function emailverification(){

        return view('emailverification');
    }





}
