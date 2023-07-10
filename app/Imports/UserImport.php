<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Karyawan;
use App\Models\Pengawas;
use App\Models\HRD;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $cekkaryawan = Karyawan::where('id_karyawan', $row[0])->first();
        $cekpengawas = Pengawas::where('id_pengawas', $row[0])->first();
        $cekhrd =HRD::where('id_hrd', $row[0])->first();
        if($cekkaryawan !== null){
            $level = 'Karyawan';
        }else if($cekpengawas !== null){
            $level = 'Pengawas';
        }else if($cekhrd !== null){
            $level = 'HRD';
        }else{
            $level = 'Karyawan';
        }

        return new User([
        'username'=> $row[0],
        'name' => $row[1],
        'email'=> $row[2],
        'password'=> Hash::make($row[3]),
        'foto_profile'=> 'pekerja.png',
        'level'=> $level,
        ]);
        
    }
}
