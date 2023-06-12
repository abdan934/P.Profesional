<?php

namespace App\Imports;

use App\Models\Pengawas;
use Maatwebsite\Excel\Concerns\ToModel;

class PengawasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pengawas([
            //
            'id_pengawas'=> $row[0],
            'name_pengawas' => $row[1],
        ]);
    }
}
