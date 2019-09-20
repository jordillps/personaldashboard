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
        // $users = DB::table('users')
        // ->join('roles', 'users.id', '=', 'roles.id')
        // ->select('users.id as id', 'roles.name as role', 'users.name as name', 'users.email as email', 'users.created_at as created_at' )
        // ->get();
        // return view('home',compact('users'));

        $users = User::all();
        foreach($users as $user){
            if($user->role_id == Role::USER){
                $user->role_id = 'user';
            }elseif($user->role_id == Role::ADMIN){
                $user->role_id = 'admin';
            }
        }
        return view('tables',compact('users'));

    }



}
