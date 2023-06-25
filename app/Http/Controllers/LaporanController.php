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
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\View;


class LaporanController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        $today = Carbon::now(new DateTimeZone('Asia/Jakarta'))->format('m-Y');
        return view('Laporan/v_laporan', compact('user','today'));
    }

    public function cari(Request $request){
        $user = Auth::user();
        $today = Carbon::now(new DateTimeZone('Asia/Jakarta'))->format('m-Y');

        $nama_kapal = $request->input('name_kapal');
        $tgl = $request->input('tgl');

        $data = DetailAbsensi::orderBy('detail_absensi.id_detail_absensi', 'desc')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')
        ->where('absensi.name_kapal','=',$nama_kapal)
        ->where('absensi.tgl','=',$tgl)
        ->get();
        return view('Laporan/v_laporan', compact('user','today','data'));
    }

    public function exportLaporan($nama_kapal, $bulan)
{
    // Mengambil data laporan dengan isi (Nama Kapal - Tanggal - Kehadiran - Nama pengawas dan personil)
    $laporan = Absensi::find($nama_kapal);

    // Mengambil detail pesanan terkait dengan laporan
    $detailLaporan = DetaiAbsensi::orderBy('detail_absensi.id_detail_absensi', 'desc')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->join('pengawas', 'pengawas.id_pengawas', '=', 'absensi.id_pengawas')
        ->whereIn('id_absensi', function ($query) use ($laporan) {
        $query->select('id')
            ->from('absensi')
            ->where('id_absensi', $laporan->id);
        })
        ->get();

    // Menampilkan view laporan.blade.php dengan data detail pesanan
    return View::make('Laporan/excel_laporan', compact('detailLaporan'));
}

}
