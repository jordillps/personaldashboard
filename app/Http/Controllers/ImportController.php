<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use App\Imports\PartnersImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index()
     {
         $partners = Partner::all();
         return view('import', compact('partners'));
     }

    /**
    * @return \Illuminate\Support\Collection
    *
    */
    public function import(Request $request) 
    {
        $validatedData = $request->validate([
            'file' => 'required',
        ]);

        Partner::truncate();
        Excel::import(new PartnersImport,request()->file('file'));
           
        return back()->with('success', "global.importedcorrectly");;
    }
}
