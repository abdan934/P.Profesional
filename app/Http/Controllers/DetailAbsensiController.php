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

class DetailAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $no = 1;
        $user = Auth::user();
        $search = request()->input('search');
        $data = DetailAbsensi::orderBy('detail_absensi.id_detail_absensi', 'desc')
                ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
                ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
                ->where(function ($query) use ($search) {
                    $query->where('absensi.id_absensi', 'LIKE', '%' . $search . '%')
                        ->orWhere('detail_absensi.id_karyawan', 'LIKE', '%' . $search . '%')
                        ->orWhere('karyawan.name_karyawan', 'LIKE', '%' . $search . '%')
                        ->orWhere('detail_absensi.waktu_absen', 'LIKE', '%' . $search . '%');
                })
                 ->paginate(5);

        return view("pages/d_absensi/v_d_absensi")->with(['user' => $user,'data'=>$data,'no'=>$no]);
        
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

       //cek status
          // Mendapatkan tanggal hari ini
          $today = Carbon::now(new DateTimeZone('Asia/Jakarta'));
          $tomorrow = Carbon::tomorrow(new DateTimeZone('Asia/Jakarta'));
          $cektoday = $today->format('Y-m-d');

        $datacreate = [
            'id_absensi' => $request->input('id_absensi'),
            'id_karyawan' => $request->input('id_karyawan'),
            'bagian' => $request->input('bagian'),
            'status' => 'HADIR',
            'waktu_absen' => $timeWIB,
        ];

        $no = 1;
        $user = Auth::user();
        $search = request()->input('search');
        $data = DetailAbsensi::orderBy('detail_absensi.id_absensi', 'asc')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->where(function ($query) use ($search) {
            $query->where('absensi.id_absensi', 'LIKE', '%' . $search . '%')
                ->orWhere('detail_absensi.id_karyawan', 'LIKE', '%' . $search . '%')
                ->orWhere('karyawan.name_karyawan', 'LIKE', '%' . $search . '%')
                ->orWhere('sift.name_sift', 'LIKE', '%' . $search . '%')
                ->orWhere('detail_absensi.waktu_absen', 'LIKE', '%' . $search . '%');
        })
        ->paginate(5);

        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->with(['user' => $user,'data'=>$data,'no'=>$no]);

        }else{
            DetailAbsensi::create($datacreate);
            $pesan = 'Berhasil ditambahkan';
            return redirect()->back()->with(['isipesan'=>$pesan,'user' => $user,'data'=>$data,'no'=>$no]);
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
        $data = DetailAbsensi::where('id_detail_absensi',$id)->first();
        $user = Auth::user();
        return view('pages/d_absensi/v_edit_d_absen')->with(['data'=>$data,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $no = 1;
        $user = Auth::user();
        $search = request()->input('search');
        $data = DetailAbsensi::orderBy('detail_absensi.id_absensi', 'asc')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->where(function ($query) use ($search) {
            $query->where('absensi.id_absensi', 'LIKE', '%' . $search . '%')
                ->orWhere('detail_absensi.id_karyawan', 'LIKE', '%' . $search . '%')
                ->orWhere('karyawan.name_karyawan', 'LIKE', '%' . $search . '%')
                ->orWhere('sift.name_sift', 'LIKE', '%' . $search . '%')
                ->orWhere('detail_absensi.waktu_absen', 'LIKE', '%' . $search . '%');
        })
        ->paginate(5);

        $update=[
            'bagian' => $request->input('bagian'),
            'status' => $request->input('status'),
        ];

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ],[
            'status.required' => 'status gagal diubah',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with(['user' => $user,'data'=>$data,'no'=>$no]);
        } else {
            try {
                DetailAbsensi::where('id_detail_absensi',$id)->update($update);
                $pesan = 'Berhasil diubah';
                return redirect()->back()->with(['isipesan' => $pesan,'user' => $user,'data'=>$data,'no'=>$no]);
            } catch (Exception $e) {
                $errorPesan = 'Gagal menambahkan: ' . $e->getMessage();
                return redirect()->back()->withErrors([$errorPesan])->with(['user' => $user,'data'=>$data,'no'=>$no]);
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $no = 1;
        $pesan = 'Berhasil dihapus';
        $search = request()->input('search');
        $data = DetailAbsensi::orderBy('detail_absensi.id_absensi', 'desc')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->join('sift', 'sift.id_sift', '=', 'absensi.id_sift')
        ->where(function ($query) use ($search) {
            $query->where('absensi.id_absensi', 'LIKE', '%' . $search . '%')
                ->orWhere('detail_absensi.id_karyawan', 'LIKE', '%' . $search . '%')
                ->orWhere('karyawan.name_karyawan', 'LIKE', '%' . $search . '%')
                ->orWhere('sift.name_sift', 'LIKE', '%' . $search . '%')
                ->orWhere('detail_absensi.waktu_absen', 'LIKE', '%' . $search . '%');
        })
        ->paginate(5);
        $user = Auth::user();
        $checkdata = DetailAbsensi::where('id_detail_absensi', $id)->first();
        if($checkdata){
            DetailAbsensi::where('id_detail_absensi',$id)->delete();
            return redirect()->back()->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }else{
            $pesan = 'Data tidak ditemukan';
            return redirect()->back()->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);
        }
    }
}
