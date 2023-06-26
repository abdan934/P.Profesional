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

    protected $idS1;
    protected $idS2;
    protected $idS3;

    public function __construct($idS1, $idS2, $idS3)
    {
        $this->idS1 = $idS1;
        $this->idS2 = $idS2;
        $this->idS3 = $idS3;
    }

    public function view(): View
    {
        
        $no=1;

        // 
        $idS1 = $this->idS1;
        $idS2 = $this->idS2;
        $idS3 = $this->idS3;


        //
        $namakapal = Absensi::select('name_kapal')
                ->where(function ($query) use ($idS1,$idS2,$idS3) {
                    $query->where('id_absensi', $idS1 )
                        ->orWhere('id_absensi', $idS2 )
                        ->orWhere('id_absensi', $idS3 );
                })
                ->first();
                if (isset($namakapal)) {
                    $namakapal = $namakapal->name_kapal;
                } else {
                    $namakapal = null; 
                }
        $tanggal = Absensi::select('tgl')
                ->where(function ($query) use ($idS1,$idS2,$idS3) {
                    $query->where('id_absensi', $idS1 )
                        ->orWhere('id_absensi', $idS2 )
                        ->orWhere('id_absensi', $idS3 );
                })
                ->first();
                if (isset($tanggal)) {
                    $tanggal = $tanggal->tgl;
                } else {
                    $tanggal = null; 
                }
                // dd($tgl);
        //data Shift 1
        $dataS1 =  DetailAbsensi::select('pengawas.name_pengawas','karyawan.name_karyawan','detail_absensi.bagian','absensi.dermaga')
        ->where('detail_absensi.id_absensi','=',$idS1)
        ->where('detail_absensi.keterangan','Masuk')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')->get();

        //data Shift 2
        $dataS2 =  DetailAbsensi::select('pengawas.name_pengawas','karyawan.name_karyawan','detail_absensi.bagian','absensi.dermaga')
        ->where('detail_absensi.id_absensi','=',$idS2)
        ->where('detail_absensi.keterangan','Masuk')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')->get();

        //data Shift 3
        $dataS3 =  DetailAbsensi::select('pengawas.name_pengawas','karyawan.name_karyawan','detail_absensi.bagian','absensi.dermaga')
        ->where('detail_absensi.id_absensi','=',$idS3)
        ->where('detail_absensi.keterangan','Masuk')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')->get();
        
        $P1 = Absensi::select('name_pengawas')
        ->where('id_absensi', $idS1)
        ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')
        ->first();
        if (isset($P1)) {
            $P1 = $P1->name_pengawas;
        } else {
            $P1 = null; 
        }
        $P2 = Absensi::select('name_pengawas')
        ->where('id_absensi', $idS2)
        ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')
        ->first();
        if (isset($P2)) {
            $P2 = $P2->name_pengawas;
        } else {
            $P2 = null; 
        }
        $P3 = Absensi::select('name_pengawas')
        ->where('id_absensi', $idS3)
        ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')
        ->first();
        if (isset($P3)) {
            $P3 = $P3->name_pengawas;
        } else {
            $P3 = null; 
        }
        return view('Laporan/excel_laporan_kapal', compact('no','dataS1','dataS2','dataS3','namakapal','tanggal','P1','P2','P3'));
    }
}
