<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengawas;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Imports\PengawasImport;
use Maatwebsite\Excel\Facades\Excel;

class PengawasController extends Controller
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
        $data = Pengawas::orderBy('id_pengawas', 'asc')->where(function ($query) use ($search) {
            $query->where('id_pengawas', 'LIKE', '%'.$search.'%')
                  ->orWhere('name_pengawas', 'LIKE', '%'.$search.'%');
        })->paginate(5);
        return view("pages/pengawas/v_pengawas")->with(['user' => $user,'data'=>$data,'no'=>$no]);
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
            'id_pengawas' => 'unique:pengawas',
        ],[
            'id_pengawas.unique' => 'Kode sudah terdaftar.',
        ]);

        $datacreate = [
            'id_pengawas' => $request->input('id_pengawas'),
            'name_pengawas' => $request->input('name_pengawas'),
        ];

        $user = Auth::user();
        $data = Pengawas::orderBy('id_pengawas','asc')->paginate(10);
        $no = 1;

        if ($validator->fails()) {
            
            return view('pages/pengawas/v_pengawas')->withErrors($validator)->with(['user' => $user,'data'=>$data,'no'=>$no]);

        }else{
            Pengawas::create($datacreate);
            $pesan = 'Berhasil ditambahkan';
            return view('pages/pengawas/v_pengawas')->with(['isipesan'=>$pesan,'user' => $user,'data'=>$data,'no'=>$no]);
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
        $data = Pengawas::where('id_pengawas',$id)->first();
        $user = Auth::user();
        return view('pages/pengawas/v_edit_pengawas')->with(['data'=>$data,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = Auth::user();
        $no = 1;
        $data = Pengawas::where('id_pengawas',$id);
        $data_update=[
            'name_pengawas' => $request->input('name_pengawas'),
        ];

        $validator = Validator::make($request->all(), [
            'name_pengawas' => 'required',
        ],[
            'name_pengawas.required' => 'Nama wajib diisi.'
        ]);

        if ($validator->fails()) {
        $pesan = 'Gagal diubah';
        return view("pages/pengawas/v_edit_pengawas")->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);

        }else{
        Pengawas::where('id_pengawas',$id)->update($data_update);
        $pesan = 'Berhasil diubah';
        return view("pages/pengawas/v_edit_pengawas")->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pesan = 'Berhasil dihapus';
        $data = Pengawas::orderBy('name_pengawas','asc')->paginate(10);
        $no = 1;
        $user = Auth::user();
        $checkdata = Pengawas::where('id_pengawas', $id)->first();
        if($checkdata){
            Pengawas::where('id_pengawas',$id)->delete();
            return view("pages/pengawas/v_pengawas")->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }else{
            // dd($id);
            $pesan = 'Data tidak ditemukan';
            return view("pages/pengawas/v_pengawas")->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);
        }
    }
}
