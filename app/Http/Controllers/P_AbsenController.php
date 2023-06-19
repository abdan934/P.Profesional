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
        $today = Carbon::now();
        $cektoday = Carbon::now()->format('Y-m-d');
        $startOfDay = Carbon::today()->startOfDay();
        $endOfDay = Carbon::today()->endOfDay();

        //waktu shift 1
        $shift1Start = Carbon::today()->setTime(0, 0, 0);
        $shift1End = Carbon::today()->setTime(8, 0, 0);
        //waktu shift 2
        $shift2Start = Carbon::today()->setTime(8, 0, 0);
        $shift2End = Carbon::today()->setTime(16, 0, 0);
        //waktu shift 3
        $shift3Start = Carbon::today()->setTime(16, 0, 0);
        $shift3End = Carbon::tomorrow()->setTime(0, 0, 0);

        $iniShift1 = $today >= $shift1Start && $today < $shift1End;
        $iniShift2 = $today >= $shift2Start && $today < $shift2End;
        $iniShift3 = $today >= $shift3Start && $today < $shift3End;
        
        //waktu shift 1 selesai
        $shift1_1Start = Carbon::today()->setTime(7, 0, 0);
        $shift1_1End = Carbon::today()->setTime(9, 0, 0);
        //waktu shift 2 selesai
        $shift2_2Start = Carbon::today()->setTime(15, 00, 0);
        $shift2_2End = Carbon::today()->setTime(17, 0, 0);
        //waktu shift 3 selesa
        $shift3_3Start = Carbon::today()->setTime(23, 0, 0);
        $shift3_3End = Carbon::tomorrow()->setTime(1, 0, 0);

        $today1= $today->format('H:i:s');
        $keluarShift1 = $today1 >= $shift1_1Start && $today1 < $shift1_1End;
        $keluarShift2 = $today >= $shift2_2Start && $today < $shift2_2End;
        $keluarShift3 = $today >= $shift3_3Start && $today < $shift3_3End;

        if ($iniShift1) {
            $id_sift = 'S-1';
        } elseif ($iniShift2) {
            $id_sift = 'S-2';
        } else {
            $id_sift = 'S-3';
        }

        $cekabsenpengawas = Absensi::join('pengawas','pengawas.id_pengawas' , '=','absensi.id_pengawas')
                ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
                ->where('absensi.id_pengawas', $idpengawas)
                ->where('absensi.id_sift', $id_sift)
                ->whereDate('absensi.tgl', $cektoday)
                ->first();

        $cekabsen = $cekabsenpengawas ? 1 : 0;
        // dd($iniShift3);

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
