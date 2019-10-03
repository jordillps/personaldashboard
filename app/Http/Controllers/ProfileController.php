<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index () {
    	$user = auth()->user();
    	return view('profile', compact('user'));
    }

    public function update (Request $request) {
		$this->validate(request(), [
			'password' => ['confirmed', new StrengthPassword]
		]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt(request('password'));
        $user->phone = $request->phone;
        $user->postalcode = $request->postalcode;
        $user->city = $request->city;
		$user->save();
	    return back()->with('message', ['success', __("Usuario actualizado correctamente")]);
    }
}
