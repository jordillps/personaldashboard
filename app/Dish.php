<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    //
    protected $fillable = ['menu_id','title','description', 'price', 'photo'];


    public function menus () {
    	return $this->belongsToMany(Menu::class);
    }
}
