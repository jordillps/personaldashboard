<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Exports\UsersExport;
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
			return back()->with('success', "Usuario eliminado correctamente");
		} catch (\Exception $exception) {
			return back()->with('success', "Error al eliminar el usuario");
		}
    }

    public function export(){
        return Excel::download(new UsersExport, 'users.ods');
    }
}
