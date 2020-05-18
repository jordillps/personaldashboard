<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Exports\CustomersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customers = Customer::all();
        return view('customers',compact('customers'));
    }

    public function destroy ($id) {
        try {
            $user= Customer::where('id', '=', $id)->first();
            $user->delete();
			return back()->with('success', "global.customerremovedcorrectly");
		} catch (\Exception $exception) {
			return back()->with('success', "global.errordeletingcustomer");
		}
    }


    public function export()
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
}
