<?php

namespace App\Imports;

use App\Models\HRD;
use Maatwebsite\Excel\Concerns\ToModel;

class HRDImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new HRD([
                'id_hrd'=> $row[0],
                'name_hrd' => $row[1],
        ]);
    }
}
