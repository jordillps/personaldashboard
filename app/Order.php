<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    const TAX = 0.10;

    protected $fillable = ['table_id','menu_id','total_no_tax','tax','total'];

    public function lineOrders(){ //$post->tag->name
        return $this->hasMany(LineOrder::class);
    }

    public function table(){
        return $this->belongsTo(TableRestaurant::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
