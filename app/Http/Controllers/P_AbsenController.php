<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTimeZone;


class P_AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $idpengawas = Auth::user()->username;

        // Mendapatkan tanggal hari ini
        $today = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        $tomorrow = Carbon::tomorrow(new DateTimeZone('Asia/Jakarta'));
        $cektoday = $today->format('Y-m-d');

        //waktu shift 1
        $shift1Start = Carbon::createFromTime(0, 0, 0, 'Asia/Jakarta');;
        $shift1End = Carbon::createFromTime(9, 0, 0, 'Asia/Jakarta');;
        //waktu shift 2
        $shift2Start = Carbon::createFromTime(8, 0, 0, 'Asia/Jakarta');
        $shift2End = Carbon::createFromTime(17, 0, 0, 'Asia/Jakarta');;
        //waktu shift 3
        $shift3Start = Carbon::createFromTime(16, 0, 0, 'Asia/Jakarta');
        $shift3End = Carbon::tomorrow(new DateTimeZone('Asia/Jakarta'))->setTime(1, 0, 0);


        

        // Waktu shift 1 selesai
        $shift1_1Start = Carbon::createFromTime(7, 0, 0, 'Asia/Jakarta');
        $shift1_1End = Carbon::createFromTime(9, 0, 0, 'Asia/Jakarta');

        // Waktu shift 2 selesai
        $shift2_2Start = Carbon::createFromTime(15, 0, 0, 'Asia/Jakarta');
        $shift2_2End = Carbon::createFromTime(17, 0, 0, 'Asia/Jakarta');

        // Waktu shift 3 selesai
        $shift3_3Start = Carbon::createFromTime(23, 30, 0,'Asia/Jakarta');
        $shift3_3End = Carbon::createFromTime(1, 0, 0,'Asia/Jakarta');
        //   $shift3_3End = Carbon::tomorrow(new DateTimeZone('Asia/Jakarta'))->setTime(1, 0, 0);

        //Shift Masuk
        $iniShift1 = ($today >= $shift1Start && $today < $shift1End);
        $iniShift2 = ($today >= $shift2Start && $today < $shift2End);
        $iniShift3 = ($today >= $shift3Start && $today < $shift3End);

        //Shift Keluar
        // $keluarShift1 = ($today >= $shift1_1Start && $today < $shift1_1End);
        // $keluarShift2 = ($today >= $shift2_2Start && $today < $shift2_2End);
        // $keluarShift3 = ($today >= $shift3_3Start && $today < $shift3_3End);
        $keluarShift1 = ($today >= $shift1_1Start );
        $keluarShift2 = ($today >= $shift2_2Start );
        $keluarShift3 = ($today >= $shift3_3Start );

        if ($iniShift1 === true) {
            $id_sift = 'S-1';
        } elseif ($iniShift2 === true) {
            $id_sift = 'S-2';
        } elseif ($iniShift3 === true) {
            $id_sift = 'S-3';
        }

        $cekabsenpengawas = Absensi::join('pengawas','pengawas.id_pengawas' , '=','absensi.id_pengawas')
                ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
                ->where('absensi.id_pengawas', $idpengawas)
                ->where('absensi.id_sift', $id_sift)
                ->where('absensi.tgl', $cektoday)
                ->first();

        $cekabsen = $cekabsenpengawas ? 1 : 0;
        // dd($keluarShift3);

        return view("pages/core/p_presensi")->with(['user' => $user,'cekabsen'=>$cekabsen,'kerja'=>$cekabsenpengawas,
        'keluar_1'=>$keluarShift1,'keluar_2'=>$keluarShift2,'keluar_3'=>$keluarShift3,'sift1'=>$iniShift1,'sift2'=>$iniShift2,'sift3'=>$iniShift3]);
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
        $tgl = now()->format('Y-m-d');
        $id_absen = $request->input('id_absensi');

        $validator = Validator::make($request->all(), [
            'id_absensi' => 'unique:absensi',
        ],[
            'id_absensi.unique' => 'Silahkan submit absen ulang.',
        ]);

        $datacreate = [
            'id_absensi' => $request->input('id_absensi'),
            'id_pengawas' => $request->input('id_pengawas'),
            'id_sift' => $request->input('id_sift'),
            'name_kapal' => $request->input('name_kapal'),
            'dermaga' => $request->input('dermaga'),
            'tgl' => $tgl,
        ];

        $user = Auth::user();
        $request->input('id_absensi');

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with(['user' => $user,'data'=>$data,'no'=>$no]);

        }else{
            Absensi::create($datacreate);
            return view('pages/core/v_presensi')->with(['id_absen'=>$id_absen,'user' => $user]);
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
}
