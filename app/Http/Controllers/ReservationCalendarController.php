<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Redirect,Response;
use App\Customer;

class ReservationCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('calendarreservation', compact('reservations'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $insertArr = [ 'name' =>$request->name,
                       'email' => $request->email,
                       'phone' =>$request->phone,
                       'reservation_date' => $request->reservation_date,
                       'start' => $request->start,
                       'end' => $request->end
                    ];
        $reservation = Reservation::insert($insertArr);

        //Create a new customer if doesn't exist
        if (!Customer::where('email', '=', $request->get('email'))->exists()) {
            // user not found
            Customer::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
             ]);

         }

        //Fill the reservation slot 
        $reservation = Reservation::all()->last();
        $reservation->slot = substr($reservation->start, 11, 5)."-".substr($reservation->end, 11, 5);
        $reservation->save();

        return Response::json($reservation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $updateArr = [  'name' =>$request->title,
                        'email' => $request->email,
                        'phone' =>$request->phone,
                        'reservation_date' => $request->start,
                        'start' => $request->start,
                        'end' => $request->end,
                        'slot' => substr($request->start, 11, 5)."-".substr($request->end, 11, 5),
                    ];
        $reservation  = Reservation::where('id', $request->id)->update($updateArr);

        return Response::json($reservation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $reservation = Reservation::where('id',$request->id)->delete();
        return Response::json($reservation);
    }
}
