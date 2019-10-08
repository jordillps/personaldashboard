<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
        return User::all('id','role_id','name','email','birthdate','avatar','created_at','updated_at');
    }

    public function headings(): array{
        return [
            'A'=>'id',
            'B'=>'role_id',
            'C'=>'Name',
            'D'=>'Email',
            'F'=>'Birthdate',
            'G'=>'Image',
            'H'=>'Created at',
            'I'=>'Updated at'
        ];
    }
}
