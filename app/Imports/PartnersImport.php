<?php

namespace App\Imports;

use App\Partner;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\Importable;

class PartnersImport implements ToModel //,WithProgressBar
{
    use Importable;
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
                'address' => $row[4],
                'donation' => $row[5],
        ]);
    }
}
