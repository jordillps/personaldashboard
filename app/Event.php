<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['user_id','title','location', 'start', 'end','created_at'];


	public function user () {
		return $this->belongsTo(User::class);
	}
}
