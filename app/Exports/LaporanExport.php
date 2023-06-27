<?php

namespace App\Exports;

use Illuminate\Http\Request;
use App\Models\DetailAbsensi;
use App\Models\Absensi;
use App\Models\Pengawas;
use App\Models\Karyawan;
use App\Models\Sift;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class LaporanExport implements FromView
{
    /**
    * @return \Illuminate\Support\view
    */

    protected $dataS1;
    protected $dataS2;
    protected $dataS3;
    protected $namakapal;
    protected $tanggal;
    protected $P1;
    protected $P2;
    protected $P3;

    public function __construct($dataS1,$dataS2,$dataS3,$namakapal,$tanggal,$P1,$P2,$P3)
    {
        $this->dataS1 = $dataS1;
        $this->dataS2 = $dataS2;
        $this->dataS3 = $dataS3;
        $this->namakapal = $namakapal;
        $this->tanggal = $tanggal;
        $this->P1 = $P1;
        $this->P2 = $P2;
        $this->P3 = $P3;
    }

    public function view(): View
    {
        $no=1;
        $dataS1 = $this->dataS1;
        $dataS2 = $this->dataS2;
        $dataS3 = $this->dataS3;
        $namakapal = $this->namakapal;
        $tanggal = $this->tanggal;
        $P1 = $this->P1;
        $P2 = $this->P2;
        $P3 = $this->P3;

        return view('Laporan/excel_laporan_kapal', compact('no','dataS1','dataS2','dataS3','namakapal','tanggal','P1','P2','P3'));
    }
}
