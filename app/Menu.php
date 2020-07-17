<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    const BREAKFAST = 1;
    const LUNCH = 2;
    const DINNER = 3;


    public function dishes () {
    	return $this->belongsToMany(Dish::class);
    }




}
