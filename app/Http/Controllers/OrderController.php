<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\LineOrder;
use App\Dish;
use App\TableRestaurant;
use App\Menu;
use Illuminate\Support\Carbon;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Arr;


class OrderController extends Controller
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
    public function store(StoreOrderRequest $request)
    {

        //Validation
        $request->validated();

        //Create New Order
        $order = Order::create([
            'table_id' => $request->get('table'),
            'menu_id' => $request->get('menu'),
        ]);

        $id_created_order = $order->id;

        $order->save();

        //Create LineOrder dishes
        $ids = $request->input('dishes_ids');
        foreach((array)$ids as $id){
            $price = Dish::find($id)->price;

            $lineOrder = LineOrder::create([
                'order_id' => $id_created_order,
                'dish_id' => $id,
                'quantity' => round($request->input('quantity.'.$id),2),
                'subtotal' => $price * $request->input('quantity.'.$id)
            ]);

            $lineOrder->save();
        }

        //Create lineOrder drinks

        //Calculate Total Order
        $lineOrders = LineOrder::where('order_id', $order->id)
            ->get();

        foreach($lineOrders as $lineOrder){
            $order->total_no_tax = $order->total_no_tax + $lineOrder->subtotal;
        }

        $order->tax = round($order->total_no_tax * Order::TAX,2);
        $order->total = $order->total_no_tax + $order->tax;
        $order->save();


        return redirect()->route('menu')->with('success', "global.ordersendedcorrectly");;



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //
        $menu_time = setMenuSchedule();

        $menu = Menu::where('id', $menu_time)->first();

        $order = Order::with('lineOrders')
        ->where('table_id', $id)
        ->where('menu_id',$menu->id)
        ->whereDate('created_at', Carbon::today())
        ->first();

        $included_dishes = array();

        foreach($order->lineOrders as $lineOrder){
            $included_dishes[] = $lineOrder->dish_id;
        }

        $table = TableRestaurant::where('id', $id)->first()->id;

        $dishes = Dish::whereHas('menus', function($query) use ($menu_time) {
            $query->where('menu_id', $menu_time);
        })
        ->whereNotIn('id', $included_dishes)
        ->orderBy('category_id')
        ->get(['id','category_id','title', 'photo']);



        return view('restaurant-table-order', compact('table', 'order', 'menu', 'dishes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //

        $lineOrders = LineOrder::where('order_id', $order->id)
            ->get();

        $order->total_no_tax = 0;

        foreach($lineOrders as $lineOrder){
            if(Arr::exists($request->quantity,$lineOrder->dish_id)){
                $lineOrder->quantity = $request->input('quantity.'.$lineOrder->dish_id);
                $lineOrder->subtotal = $lineOrder->quantity * $lineOrder->dish->price;
                $lineOrder->save();
            }


            $order->total_no_tax = $order->total_no_tax + $lineOrder->subtotal;

        }

        $order->tax = round($order->total_no_tax * Order::TAX,2);
        $order->total = $order->total_no_tax + $order->tax;
        $order->save();

        return back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
