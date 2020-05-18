<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomersExport implements FromCollection
{
     /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
        return Customer::all('id','name','email','created_at','updated_at');
    }

    public function headings(): array{
        return [
            'A'=>'id',
            'B'=>'Name',
            'C'=>'Email',
            'D'=>'Created at',
            'E'=>'Updated at'
        ];
    }
}
