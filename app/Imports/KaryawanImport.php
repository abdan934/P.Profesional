<?php

namespace App\Imports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 

class KaryawanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         //generatecode
         $qrCode = QrCode::format('png')->generate( $row[0]);
         $qrCodeFileName = 'qrcode_' . $row[0] . '.png';
         $qrCodeFile = 'QRcode/' . $qrCodeFileName;
         file_put_contents($qrCodeFile, $qrCode);

        return new Karyawan([
            //
            'id_karyawan'=> $row[0],
            'name_karyawan' => $row[1],
            'qr_karyawan' => $qrCodeFileName,
        ]);
    }
}
