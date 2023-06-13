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
        $data = DetailAbsensi::orderBy('detail_absensi.id_sift', 'asc')
                ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
                ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
                ->join('sift', 'sift.id_sift', '=', 'detail_absensi.id_sift')
                ->where(function ($query) use ($search) {
                    $query->where('absensi.id_absensi', 'LIKE', '%' . $search . '%')
                        ->orWhere('detail_absensi.id_karyawan', 'LIKE', '%' . $search . '%')
                        ->orWhere('karyawan.name_karyawan', 'LIKE', '%' . $search . '%')
                        ->orWhere('detail_absensi.id_sift', 'LIKE', '%' . $search . '%')
                        ->orWhere('sift.name_sift', 'LIKE', '%' . $search . '%')
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
            'id_sift' => Rule::exists('sift', 'id_sift'),
        ],[
            'id_detail_absensi.unique' => 'Anda sudah absen.',
            'id_absensi.exists' => 'Kode tidak ditemukan',
            'id_karyawan.exists' => 'Kode tidak ditemukan',
            'id_sift.exists' => 'Kode tidak ditemukan',
        ]);

        $datacreate = [
            'id_absensi' => $request->input('id_absensi'),
            'id_karyawan' => $request->input('id_karyawan'),
            'id_sift' => $request->input('id_sift'),
            'name_kapal' => $request->input('name_kapal'),
            'bagian' => $request->input('bagian'),
            'dermaga' => $request->input('dermaga'),
            'keterangan' => $request->input('keterangan'),
            'waktu_absen' => Carbon::now()->format('H:i:s'),
        ];

        $no = 1;
        $user = Auth::user();
        $search = request()->input('search');
        $data = DetailAbsensi::orderBy('detail_absensi.id_sift', 'asc')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->join('sift', 'sift.id_sift', '=', 'detail_absensi.id_sift')
        ->where(function ($query) use ($search) {
            $query->where('absensi.id_absensi', 'LIKE', '%' . $search . '%')
                ->orWhere('detail_absensi.id_karyawan', 'LIKE', '%' . $search . '%')
                ->orWhere('karyawan.name_karyawan', 'LIKE', '%' . $search . '%')
                ->orWhere('detail_absensi.id_sift', 'LIKE', '%' . $search . '%')
                ->orWhere('sift.name_sift', 'LIKE', '%' . $search . '%')
                ->orWhere('detail_absensi.waktu_absen', 'LIKE', '%' . $search . '%');
        })
        ->paginate(5);

        if ($validator->fails()) {
            
            return view('pages/d_absensi/v_d_absensi')->withErrors($validator)->with(['user' => $user,'data'=>$data,'no'=>$no]);

        }else{
            DetailAbsensi::create($datacreate);
            $pesan = 'Berhasil ditambahkan';
            return view('pages/d_absensi/v_d_absensi')->with(['isipesan'=>$pesan,'user' => $user,'data'=>$data,'no'=>$no]);
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
        $no = 1;
        $pesan = 'Berhasil dihapus';
        $search = request()->input('search');
        $data = DetailAbsensi::orderBy('detail_absensi.id_sift', 'asc')
        ->join('absensi','detail_absensi.id_absensi' , '=','absensi.id_absensi')
        ->join('karyawan', 'karyawan.id_karyawan', '=', 'detail_absensi.id_karyawan')
        ->join('sift', 'sift.id_sift', '=', 'detail_absensi.id_sift')
        ->where(function ($query) use ($search) {
            $query->where('absensi.id_absensi', 'LIKE', '%' . $search . '%')
                ->orWhere('detail_absensi.id_karyawan', 'LIKE', '%' . $search . '%')
                ->orWhere('karyawan.name_karyawan', 'LIKE', '%' . $search . '%')
                ->orWhere('detail_absensi.id_sift', 'LIKE', '%' . $search . '%')
                ->orWhere('sift.name_sift', 'LIKE', '%' . $search . '%')
                ->orWhere('detail_absensi.waktu_absen', 'LIKE', '%' . $search . '%');
        })
        ->paginate(5);
        $user = Auth::user();
        $checkdata = DetailAbsensi::where('id_detail_absensi', $id)->first();
        if($checkdata){
            DetailAbsensi::where('id_detail_absensi',$id)->delete();
            return view("pages/d_absensi/v_d_absensi")->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }else{
            $pesan = 'Data tidak ditemukan';
            return view("pages/d_absensi/v_d_absensi")->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);
        }
    }
}
