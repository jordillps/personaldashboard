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

        $request->validate([
            'name' => ['required', 'regex:/^[A-ZÀÁÇÉÈËÏÍÌÓÒÚÙÜÚÑa-zàáçéèëïóòúüñ. ]+$/','min:4'],
            'email' =>  'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'nullable|digits:9',
            'postalcode' => 'nullable|digits:5',
            'city' => ['nullable', 'regex:/^[A-ZÀÁÇÉÈËÏÍÌÓÒÚÙÜÚÑa-zàáçéèëïóòúüñ. ]+$/'],
        ]);


        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password != null || $request->password_confirmation != null){
            $this->validate(request(), [
                'password' => ['required','confirmed', new StrengthPassword],
                'password_confirmation' => 'required',
            ]);

			if($request->password != $user->password){
            	$user->password = bcrypt(request('password'));
        	}
        }

        //Avatar
        if($request->avatar != null){
            $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

            //LocalHost
            $request->avatar->storeAs('avatars',$avatarName);

            //Servidor
            //$path = base_path();
            //Personaldasboard:nom carpeta projecte
            //httpdocs: nom carpeta principal al servidor
			//$path = str_replace("personaldashboard", "httpdocs", $path);
			//$destinationPath = $path . '/storage/avatars';
			//$request->avatar->move($destinationPath, $avatarName);

            $user->avatar = $avatarName;
        }


        $user->phone = $request->phone;
        $user->birthdate = $request->birthdate;
        $user->postalcode = $request->postalcode;
        $user->city = $request->city;
		$user->save();
        return back()->with('success', "Usuario actualizado correctamente");
    }
}
