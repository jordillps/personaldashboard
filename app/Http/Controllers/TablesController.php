<?php

namespace App\Http\Controllers;

use App\User;
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
        $users = DB::table('users')
        ->join('roles', 'users.id', '=', 'roles.id')
        ->select('users.id as id', 'roles.name as role', 'users.name as name', 'users.email as email', 'users.created_at as created_at' )
        ->get();
        return view('tables',compact('users'));
    }
}
