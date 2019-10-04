<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\StrengthPassword;

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

        $request->validate([
            'name' => ['required', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑa-zàâçéèêëîïôûùüÿñ. ]+$/','min:4'],
            'email' =>  'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'nullable|digits:9',
            'postalcode' => 'nullable|digits:5',
            'city' => ['nullable', 'regex:/^[A-ZÀÂÇÉÈÊËÎÏÔÛÙÜŸÑa-zàâçéèêëîïôûùüÿñ. ]+$/'],
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;

        //Avatar
        if($request->avatar != null){
            $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars',$avatarName);
            $user->avatar = $avatarName;
        }


        $user->password = bcrypt(request('password'));
        $user->phone = $request->phone;
        $user->postalcode = $request->postalcode;
        $user->city = $request->city;
		$user->save();
        return back()->with('success', "Usuario actualizado correctamente");
    }
}
