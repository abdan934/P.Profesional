<?php

namespace App\Imports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;

class KaryawanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Karyawan([
            //
            'id_karyawan'=> $row[0],
            'name_karyawan' => $row[1],
        ]);
    }
}
