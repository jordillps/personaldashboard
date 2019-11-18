<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
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
			return back()->with('success', "global.userremovedcorrectly");
		} catch (\Exception $exception) {
			return back()->with('success', "global.errordeletinguser");
		}
    }


    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
