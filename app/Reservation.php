<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Traits\Enums;

class Reservation extends Model
{
    use Enums;
    //
    protected $fillable = [
        'name','email','phone', 'reservation_date', 'slot',
     ];

    protected $dates = ['reservation_date'];


    //Mutador para calcular reservation_date
    public function setReservationDateAttribute($reservation_date)
    {
        $this->attributes['reservation_date'] = Carbon::parse($reservation_date);
    }


    public $enumSlots = [
        '10:00-10:30',
        '10:30-11:00',
        '11:00-11:30',
        '11:30-12:00',
        '12:00-12:30',
        '12:30-13:00',
        '13:00-13:30',
        '13:30-14:00',
        '17:00-17:30',
        '17:30-18:00',
        '18:00-18:30',
        '18:30-19:00',
        '19:00-19:30',
        '19:30-20:00'
    ];





}
