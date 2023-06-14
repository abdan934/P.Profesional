<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
        'username'=> $row[0],
        'name' => $row[1],
        'email'=> $row[2],
        'password'=> Hash::make($row[3]),
        'foto_profile'=> 'pekerja.png',
        'level'=> $row[4],
        ]);
    }
}
