<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;
use App\Models\DetailAbsensi;
use Carbon\Carbon;
use DateTimeZone;

class DashboardController extends Controller
{
    //
    public function index(Request $request){
        //realtime WIB
        $now = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        $timeWIB = $now->format('H:i');

        $username_login = $request->session()->get('username_login');
        $user = Auth::user();

        //cek absen karyawan hari ini
        $k_shift1 = '';
        $k_shift2 = '';
        $k_shift3 = '';
        if($user->level=== 'Karyawan'){
             // Mendapatkan tanggal hari ini
            $today = Carbon::now(new DateTimeZone('Asia/Jakarta'));
            $tomorrow = Carbon::tomorrow(new DateTimeZone('Asia/Jakarta'));
            $cektoday = $today->format('Y-m-d');

            //shift 1
            $k_shift1 = DetailAbsensi::where('id_karyawan',$user->username)
            ->join('absensi','absensi.id_absensi','=','detail_absensi.id_absensi')
            ->join('pengawas','pengawas.id_pengawas','=','absensi.id_pengawas')
            ->where('absensi.tgl',$cektoday)
            ->where('absensi.id_sift','S-1')
            ->first();

            //shift 2
            $k_shift2 = DetailAbsensi::where('id_karyawan',$user->username)
            ->join('absensi','absensi.id_absensi','=','detail_absensi.id_absensi')
            ->join('pengawas','pengawas.id_pengawas','=','absensi.id_pengawas')
            ->where('absensi.tgl',$cektoday)
            ->where('absensi.id_sift','S-2')
            ->first();

            //shift 3
            $k_shift3 = DetailAbsensi::where('id_karyawan',$user->username)
            ->join('absensi','absensi.id_absensi','=','detail_absensi.id_absensi')
            ->join('pengawas','pengawas.id_pengawas','=','absensi.id_pengawas')
            ->where('absensi.tgl',$cektoday)
            ->where('absensi.id_sift','S-3')
            ->first();
        }
        return view("pages/v_dashboard")->with(['user' => $user,'time'=>$timeWIB,'k_shift1'=>$k_shift1,'k_shift2'=>$k_shift2,'k_shift3'=>$k_shift3]);
    }
}
