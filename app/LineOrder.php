<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineOrder extends Model
{
    //
    protected $fillable = ['order_id','dish_id','quantity','subtotal'];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function dish(){
        return $this->belongsTo(Dish::class);
    }

}
