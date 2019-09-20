<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use DB;
use Illuminate\Http\Request;

class TablesController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        foreach($users as $user){
            if($user->role_id == Role::USER){
                $user->role_id = 'user';
            }
            if($user->role_id == Role::ADMIN){
                $user->role_id = 'admin';
            }
        }
        return view('tables',compact('users'));
    }
}
