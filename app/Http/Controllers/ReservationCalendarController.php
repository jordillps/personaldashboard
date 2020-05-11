<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Redirect,Response;

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

        $insertArr = [ 'name' =>$request->title,
                       'email' => $request->email,
                       'phone' =>$request->phone,
                       'reservation_date' => $request->reservation_date,
                       'start' => $request->start,
                       'end' => $request->end
                    ];
        $reservation = Reservation::insert($insertArr);

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
