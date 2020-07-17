<?php

namespace App\Http\Controllers;

use App\LineOrder;
use App\Order;
use App\Dish;
use Illuminate\Http\Request;


class LineOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        //

        $quantities = $request->input('quantity');

        //Create LineOrder
        foreach($quantities as $key => $value){
            if($value != null){
                $price = Dish::find($key)->price;
                $lineOrder = LineOrder::create([
                    'order_id' => $order->id,
                    'dish_id' => $key,
                    'quantity' => round($value,2),
                    'subtotal' => $price * $value
                ]);

                $lineOrder->save();

            }

        }

        //Calculate Order
        $lineOrders = LineOrder::where('order_id', $order->id)
            ->get();

        $order->total_no_tax = 0;

        foreach($lineOrders as $lineOrder){
            $order->total_no_tax = $order->total_no_tax + $lineOrder->subtotal;
        }

        $order->tax = round($order->total_no_tax * Order::TAX,2);
        $order->total = $order->total_no_tax + $order->tax;
        $order->save();


        return back();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LineOrder  $lineOrder
     * @return \Illuminate\Http\Response
     */
    public function show(LineOrder $lineOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LineOrder  $lineOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(LineOrder $lineOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LineOrder  $lineOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LineOrder $lineOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LineOrder  $lineOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(LineOrder $lineOrder)
    {
        //
    }
}
