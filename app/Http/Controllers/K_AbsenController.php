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

class K_AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $id=$request->input('id_absensi');
        $user = Auth::user();
        $no = 1;
           //
           $data = DetailAbsensi::orderBy('detail_absensi.id_detail_absensi', 'desc')
           ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
           ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
           ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
           ->where('absensi.id_absensi','=',$id)
           ->where('detail_absensi.id_absensi','=',$id)
           ->paginate(10);
           $validator = Validator::make($request->all(), [
            'id_detail_absensi' => 'unique:detail_absensi',
            'id_absensi' => Rule::exists('absensi', 'id_absensi'),
            'id_karyawan' => Rule::exists('karyawan', 'id_karyawan'),
            
        ],[
            'id_detail_absensi.unique' => 'Anda sudah absen.',
            'id_absensi.exists' => 'Kode tidak ditemukan',
            'id_karyawan.exists' => 'Kode tidak ditemukan',
            'id_sift.exists' => 'Kode tidak ditemukan',
        ]);
        $cekabsen = DetailAbsensi::join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->where('detail_absensi.id_karyawan','=',$request->input('id_karyawan'))
        ->where('detail_absensi.id_absensi','=',$request->input('id_absensi'))
        ->where('detail_absensi.keterangan','=',$request->input('keterangan'))
        ->first();
       //cek status
          // Mendapatkan tanggal hari ini
          $today = Carbon::now(new DateTimeZone('Asia/Jakarta'));
          $tomorrow = Carbon::tomorrow(new DateTimeZone('Asia/Jakarta'));
          $cektoday = $today->format('Y-m-d');
          $timeWIB = $today->format('H:i:s');
        
        $datacreate = [
            'id_absensi' => $request->input('id_absensi'),
            'id_karyawan' => $request->input('id_karyawan'),
            'bagian' => $request->input('bagian'),
            'status' => 'HADIR',
            'keterangan' => $request->input('keterangan'),
            'waktu_absen' => $timeWIB,
        ];

        if($cekabsen !== null){
            $pesan = 'Sudah absen !!!';
            return redirect()->back()->withErrors($pesan);
        } 
        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator);

        }else{
            DetailAbsensi::create($datacreate);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function detail($id)
    {
        //
        $user = Auth::user();
        $no = 1;
        $no_1 = 1;
        $data_m = DetailAbsensi::orderBy('detail_absensi.id_detail_absensi', 'desc')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->where('absensi.id_absensi','=',$id)
        ->where('detail_absensi.id_absensi','=',$id)
        ->where('detail_absensi.keterangan','=','Masuk')
        ->paginate(10);
        $data_k = DetailAbsensi::orderBy('detail_absensi.id_detail_absensi', 'desc')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->where('absensi.id_absensi','=',$id)
        ->where('detail_absensi.id_absensi','=',$id)
        ->where('detail_absensi.keterangan','=','Keluar')
        ->paginate(10);

        //
        // Mendapatkan tanggal hari ini
        $today = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        // Waktu shift 1 selesai
        $shift1_1Start = Carbon::createFromTime(7, 0, 0, 'Asia/Jakarta');

        // Waktu shift 2 selesai
        $shift2_2Start = Carbon::createFromTime(15, 0, 0, 'Asia/Jakarta');

        // Waktu shift 3 selesai
        $shift3_3Start = Carbon::createFromTime(23, 0, 0,'Asia/Jakarta');

        //Shift Keluar
        $cek_keluar = DetailAbsensi::select('absensi.id_sift')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->where('detail_absensi.id_absensi','=',$id)->first();
        // dd($cek_keluar);
        if(isset($cek_keluar)){
            if($cek_keluar->id_sift === 'S-1'){
                $keluarShift = ($today >= $shift1_1Start );
            }elseif($cek_keluar->id_sift === 'S-2'){
                $keluarShift = ($today >= $shift2_2Start );
            }elseif($cek_keluar->id_sift === 'S-3'){
                $keluarShift = ($today >= $shift3_3Start );
            }
        }else{
            $keluarShift = false;
        }
        
        return view('pages/core/v_presensi')->with(['id_absen'=>$id,'user' => $user,'data_m' => $data_m,'data_k' => $data_k,'no'=>$no,'no_1'=>$no_1,'keluar'=>$keluarShift]);
    }

    //cek absensi
    public function cekabsensi_k()
    {
        $no = 1;
        $search = request()->input('search');
        $user = Auth::user();
        $today = Carbon::now(new DateTimeZone('Asia/Jakarta'))->format('Y-m-d');
        $bulansekarang = Carbon::now(new DateTimeZone('Asia/Jakarta'))->format('Y-M');
        $bulan = Carbon::now(new DateTimeZone('Asia/Jakarta'))->format('m');

        $data_absen = DetailAbsensi::where('detail_absensi.id_karyawan',$user->username)
        ->where('tgl', 'LIKE', '%'.$bulan.'%')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('karyawan','detail_absensi.id_karyawan' , '=','karyawan.id_karyawan')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->get();

        $data_absen_s =null;
        if(isset($search)){
        $data_absen_s = DetailAbsensi::where('detail_absensi.id_karyawan',$user->username)
        ->where(function ($query) use ($search) {
            $query->where('tgl', 'LIKE', '%'.$search.'%');
        })
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('karyawan','detail_absensi.id_karyawan' , '=','karyawan.id_karyawan')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->get();
        }

        return view('Laporan/k_laporan')->with(['today'=>$today,'user'=>$user,'data_absen'=>$data_absen,'data_absen_s'=>$data_absen_s,'no'=>$no,'bulansekarang'=>$bulansekarang]);
    }
}
