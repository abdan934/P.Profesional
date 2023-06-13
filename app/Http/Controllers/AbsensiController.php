<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Pengawas;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Imports\AbsensiImport;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
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
        $data = Absensi::orderBy('tgl', 'asc')
                ->join('pengawas', 'absensi.id_pengawas', '=', 'pengawas.id_pengawas')
                ->where(function ($query) use ($search) {
                    $query->where('absensi.id_absensi', 'LIKE', '%' . $search . '%')
                        ->orWhere('absensi.id_pengawas', 'LIKE', '%' . $search . '%')
                        ->orWhere('pengawas.name_pengawas', 'LIKE', '%' . $search . '%')
                        ->orWhere('absensi.tgl', 'LIKE', '%' . $search . '%');
                })
    ->paginate(5);
        return view("pages/absensi/v_absensi")->with(['user' => $user,'data'=>$data,'no'=>$no]);
        
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
            'id_absensi' => 'unique:absensi',
            'id_pengawas' => Rule::exists('pengawas', 'id_pengawas'),
        ],[
            'id_absensi.unique' => 'Anda sudah absen.',
            'id_pengawas.exists' => 'Kode tidak ditemukan',
        ]);

        $datacreate = [
            'id_pengawas' => $request->input('id_pengawas'),
            'tgl' => $request->input('tgl'),
        ];

        $no = 1;
        $user = Auth::user();
        $data = Absensi::orderBy('tgl','asc')->paginate(10);

        if ($validator->fails()) {
            
            return view('pages/absensi/v_absensi')->withErrors($validator)->with(['user' => $user,'data'=>$data,'no'=>$no]);

        }else{
            Absensi::create($datacreate);
            $pesan = 'Berhasil ditambahkan';
            return view('pages/absensi/v_absensi')->with(['isipesan'=>$pesan,'user' => $user,'data'=>$data,'no'=>$no]);
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
        $data = Absensi::orderBy('tgl','asc')->paginate(10);
        $user = Auth::user();
        $checkdata = Absensi::where('id_absensi', $id)->first();
        if($checkdata){
            Absensi::where('id_absensi',$id)->delete();
            return view("pages/absensi/v_absensi")->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }else{
            $pesan = 'Data tidak ditemukan';
            return view("pages/absensi/v_absensi")->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);
        }
    }
    
}
