<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    //
    function setLocale($locale){
        Session::put('locale', $locale);
        return redirect()->back();
    }
}
