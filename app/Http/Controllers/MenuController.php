<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use App\Dish;
use App\Order;
use Illuminate\Support\Carbon;
use App\TableRestaurant;
use app\Helpers\Helper;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $menu_time = setMenuSchedule();

        $dishes = Dish::whereHas('menus', function($query) use ($menu_time) {
                $query->where('menu_id', $menu_time);
        })
        ->orderBy('category_id')
        ->get(['id','category_id','title', 'price', 'description', 'photo']);

        $current_menu = Menu::where('id', $menu_time)->first();
        $tables = TableRestaurant::all(['id']);


        $unavailable_tables = Order::where('menu_id',$current_menu->id)
        ->whereDate('created_at', Carbon::today())
        ->pluck('table_id')->toArray();


        $num_dishes = $dishes->where('category_id', 1)->count();
        $num_drinks= $dishes->where('category_id', 2)->count();

        return view('menus.menu', compact('dishes', 'current_menu', 'tables', 'num_dishes', 'num_drinks', 'unavailable_tables'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
    }



}
