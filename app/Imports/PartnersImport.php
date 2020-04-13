<?php

namespace App\Imports;

use App\Partner;
use Maatwebsite\Excel\Concerns\ToModel;

class PartnersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Partner([
                'name'     => $row[1],
                'email'    => $row[2], 
                'birthdate' => $row[3],
        ]);
    }
}
