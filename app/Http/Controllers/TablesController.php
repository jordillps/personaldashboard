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
        $users = User::with('role')->get();
        return view('tables',compact('users'));
    }

    public function destroy ($id) {
        try {
            $user= User::where('id', '=', $id)->first();
            $user->delete();
			return back()->with('message', ['success', __("Usuario profesor eliminado correctamente")]);
		} catch (\Exception $exception) {
			return back()->with('message', ['danger', __("Error eliminando el profesor")]);
		}
    }
}
