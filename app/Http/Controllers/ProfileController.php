<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\StrengthPassword;
use App\Http\Controllers\lang;

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
            'name' => ['required', 'regex:/^[A-ZÀÁÇÉÈËÏÍÌÓÒÚÙÜÚÑa-zàáçéèëïíóòúüñ. ]+$/','min:4'],
            'email' =>  'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_width=300,max_height=300',
            'phone' => 'nullable|digits:9',
            'postalcode' => 'nullable|digits:5',
            'city' => ['nullable', 'regex:/^[A-ZÀÁÇÉÈËÏÍÌÓÒÚÙÜÚÑa-zàáçéèëïíóòúüñ. ]+$/'],
        ]);


        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->filled('password') || $request->filled('password_confirmation')){
            $this->validate(request(), [
                //corfirmed comprova la confirmació del password
                'password' => ['required','confirmed', new StrengthPassword],
            ]);

            $user->password = bcrypt(request('password'));
        }

        //Avatar
        if($request->avatar != null){
            $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

            //LocalHost
            $request->avatar->storeAs('avatars',$avatarName);

            //Servidor
            //$path = base_path();
            //Personaldasboard:nom carpeta projecte
            //httpdocs: nom carpeta on posem el directori public servidor
			//$path = str_replace("personaldashboard", "httpdocs", $path);
			//$destinationPath = $path . '/storage/avatars';
			//$request->avatar->move($destinationPath, $avatarName);

            //Servidor quan fem redirecció a la carpeta public
            //$path = public_path();
            //Cal crear les carpetes storage/avatars a la carpeta public
			//$destinationPath = $path . '/storage/avatars';
			//$request->avatar->move($destinationPath, $avatarName);


            $user->avatar = $avatarName;
        }


        $user->phone = $request->phone;
        $user->birthdate = $request->birthdate;
        $user->postalcode = $request->postalcode;
        $user->city = $request->city;
        $user->googlecalendarid = $request->googlecalendarid;
        $user->googlecalendarapikey = $request->googlecalendarapikey;
		$user->save();
        return back()->with('success', "global.userupdatedcorrectly");
    }
}
