<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailAbsensi;
use App\Models\Absensi;
use App\Models\Pengawas;
use App\Models\Karyawan;
use App\Models\Sift;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Imports\AbsensiImport;
use Carbon\Carbon;
use DateTimeZone;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\View;
use App\Exports\LaporanExport;


class LaporanController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        $today = Carbon::now(new DateTimeZone('Asia/Jakarta'))->format('Y-m-d');
        return view('Laporan/v_laporan', compact('user','today'));
    }

    public function cari(Request $request){
        $user = Auth::user();
        $no=1;
        $today = Carbon::now(new DateTimeZone('Asia/Jakarta'))->format('Y-m-d');

        $nama_kapal = $request->input('name_kapal');
        $tgl = $request->input('tgl');

        $namakapal = Absensi::select('name_kapal')
        ->where('name_kapal', $nama_kapal)
        ->where('tgl', $tgl)
        ->first();
       
        if (isset($namakapal)) {
            $namakapal = $namakapal->name_kapal;
        } else {
            $namakapal = null; 
        }
        //  dd($namakapal);
    
        $tanggal = Absensi::select('tgl')
        ->where('name_kapal', $nama_kapal)
        ->where('tgl', $tgl)
        ->first();
        if (isset($tanggal)) {
            $tanggal = $tanggal->tgl;
        } else {
            $tanggal = null; 
        }
        
    
                $P1 = Absensi::select('name_pengawas')
                ->where('name_kapal', $nama_kapal)
                ->where('tgl', $tgl)
                ->where('id_sift', 'S-1')
                ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')
                ->first();
                if (isset($P1)) {
                    $P1 = $P1->name_pengawas;
                } else {
                    $P1 = null; 
                }
                $P2 = Absensi::select('name_pengawas')
                ->where('name_kapal', $nama_kapal)
                ->where('tgl', $tgl)
                ->where('id_sift', 'S-2')
                ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')
                ->first();
                if (isset($P2)) {
                    $P2 = $P2->name_pengawas;
                } else {
                    $P2 = null; 
                }
                $P3 = Absensi::select('name_pengawas')
                ->where('name_kapal', $nama_kapal)
                ->where('tgl', $tgl)
                ->where('id_sift', 'S-3')
                ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')
                ->first();
                if (isset($P3)) {
                    $P3 = $P3->name_pengawas;
                } else {
                    $P3 = null; 
                }

                $idS1 = Absensi::select('id_absensi')
                ->where('name_kapal', $nama_kapal)
                ->where('tgl', $tgl)
                ->where('id_sift', 'S-1')
                ->first();
                if (isset($idS1)) {
                    $idS1 = $idS1->id_absensi;
                } else {
                    $idS1 = null; 
                }

                $dataS1 =  DetailAbsensi::select('pengawas.name_pengawas','karyawan.name_karyawan','detail_absensi.status','detail_absensi.bagian','absensi.dermaga')
                ->where('detail_absensi.id_absensi','=',$idS1)
                ->where('detail_absensi.keterangan','Masuk')
                ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
                ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
                ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
                ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas');

                $idS2 = Absensi::select('id_absensi')
                ->where('name_kapal', $nama_kapal)
                ->where('tgl', $tgl)
                ->where('id_sift', 'S-2')
                ->first();
                if (isset($idS2)) {
                    $idS2 = $idS2->id_absensi;
                } else {
                    $idS2 = null; 
                }
                    
                    $dataS2 =  DetailAbsensi::select('pengawas.name_pengawas','karyawan.name_karyawan','detail_absensi.status','detail_absensi.bagian','absensi.dermaga')
                    ->where('detail_absensi.id_absensi','=',$idS2)
                    ->where('detail_absensi.keterangan','Masuk')
                    ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
                    ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
                    ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
                    ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas');
        
                    $idS3 = Absensi::select('id_absensi')
                    ->where('name_kapal', $nama_kapal)
                    ->where('tgl', $tgl)
                    ->where('id_sift', 'S-3')
                    ->first();
                    if (isset($idS3)) {
                        $idS3 = $idS3->id_absensi;
                    } else {
                        $idS3 = null; 
                    }
                    
                    $dataS3 =  DetailAbsensi::select('pengawas.name_pengawas','karyawan.name_karyawan','detail_absensi.status','detail_absensi.bagian','absensi.dermaga')
                    ->where('detail_absensi.id_absensi','=',$idS3)
                    ->where('detail_absensi.keterangan','Masuk')
                    ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
                    ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
                    ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
                    ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')->get();

        return view('Laporan/v_laporan', compact('user','today','no','dataS1','dataS2','dataS3','namakapal','tanggal','P1','P2','P3','idS1','idS2','idS3'));

    }


    public function cetak(Request $request){
        
        $no=1;

        // 
        $idS1 = $request->input('id_1');
        $idS2 = $request->input('id_2');
        $idS3 = $request->input('id_3');

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
        $dataS1 =  DetailAbsensi::select('pengawas.name_pengawas','karyawan.name_karyawan','detail_absensi.status','detail_absensi.bagian','absensi.dermaga')
        ->where('detail_absensi.id_absensi','=',$idS1)
        ->where('detail_absensi.keterangan','Masuk')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')->get();

        //data Shift 2
        $dataS2 =  DetailAbsensi::select('pengawas.name_pengawas','karyawan.name_karyawan','detail_absensi.status','detail_absensi.bagian','absensi.dermaga')
        ->where('detail_absensi.id_absensi','=',$idS2)
        ->where('detail_absensi.keterangan','Masuk')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')->get();

        //data Shift 3
        $dataS3 =  DetailAbsensi::select('pengawas.name_pengawas','karyawan.name_karyawan','detail_absensi.status','detail_absensi.bagian','absensi.dermaga')
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

    public function exportLaporan(Request $request)
{
    // 
    $idS1 = $request->input('id_1');
    $idS2 = $request->input('id_2');
    $idS3 = $request->input('id_3');

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
    $dataS1 =  DetailAbsensi::select('pengawas.name_pengawas','karyawan.name_karyawan','detail_absensi.status','detail_absensi.bagian','absensi.dermaga')
    ->where('detail_absensi.id_absensi','=',$idS1)
    ->where('detail_absensi.keterangan','Masuk')
    ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
    ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
    ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
    ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')->get();

    //data Shift 2
    $dataS2 =  DetailAbsensi::select('pengawas.name_pengawas','karyawan.name_karyawan','detail_absensi.status','detail_absensi.bagian','absensi.dermaga')
    ->where('detail_absensi.id_absensi','=',$idS2)
    ->where('detail_absensi.keterangan','Masuk')
    ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
    ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
    ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
    ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')->get();

    //data Shift 3
    $dataS3 =  DetailAbsensi::select('pengawas.name_pengawas','karyawan.name_karyawan','detail_absensi.status','detail_absensi.bagian','absensi.dermaga')
    ->where('detail_absensi.id_absensi','=',$idS3)
    ->where('detail_absensi.keterangan','Masuk')
    ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
    ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
    ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
    ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')->get();
    
    $P1 = Absensi::select('name_pengawas','tgl','name_kapal')
    ->where('id_absensi', $idS1)
    ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')
    ->first();
    if (isset($P1)) {
        $P1_1 = $P1->name_pengawas;
    } else {
        $P1 = null; 
    }
    $P2 = Absensi::select('name_pengawas','tgl','name_kapal')
    ->where('id_absensi', $idS2)
    ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')
    ->first();
    if (isset($P2)) {
        $P2 = $P2->name_pengawas;
    } else {
        $P2 = null; 
    }
    $P3 = Absensi::select('name_pengawas','tgl','name_kapal')
    ->where('id_absensi', $idS3)
    ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')
    ->first();
    if (isset($P3)) {
        $P3 = $P3->name_pengawas;
    } else {
        $P3 = null; 
    }
      return Excel::download(new LaporanExport($dataS1,$dataS2,$dataS3,$namakapal,$tanggal,$P1,$P2,$P3), 'Laporan.xlsx');
}

}
