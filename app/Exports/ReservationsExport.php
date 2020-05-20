<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Reservation;

class ReservationsExport implements FromCollection
{
      /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
        return Reservation::all('id','name','email','phone','reservation_date','slot','created_at','updated_at');
    }

    public function headings(): array{
        return [
            'A'=>'id',
            'B'=>'Name',
            'C'=>'Email',
            'D'=>'Phone',
            'E'=>'Date',
            'F'=>'Hour',
            'G'=>'Created at',
            'H'=>'Updated at'
        ];
    }
}
