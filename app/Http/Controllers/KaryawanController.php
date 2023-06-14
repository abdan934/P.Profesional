<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Imports\KaryawanImport;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
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
        $data = Karyawan::orderBy('id_karyawan', 'asc')->where(function ($query) use ($search) {
            $query->where('id_karyawan', 'LIKE', '%'.$search.'%')
                  ->orWhere('name_karyawan', 'LIKE', '%'.$search.'%');
        })->paginate(5);
        return view("pages/karyawan/v_karyawan")->with(['user' => $user,'data'=>$data,'no'=>$no]);
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
            'id_karyawan' => 'unique:karyawan',
        ],[
            'id_karyawan.unique' => 'Kode sudah terdaftar.',
        ]);

        $datacreate = [
            'id_karyawan' => $request->input('id_karyawan'),
            'name_karyawan' => $request->input('name_karyawan'),
        ];

        $user = Auth::user();
        $data = Karyawan::orderBy('id_karyawan','asc')->paginate(10);
        $no = 1;

        if ($validator->fails()) {
            
            return view('pages/karyawan/v_karyawan')->withErrors($validator)->with(['user' => $user,'data'=>$data,'no'=>$no]);

        }else{
            Karyawan::create($datacreate);
            $pesan = 'Berhasil ditambahkan';
            return view('pages/karyawan/v_karyawan')->with(['isipesan'=>$pesan,'user' => $user,'data'=>$data,'no'=>$no]);
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
        $data = Karyawan::where('id_karyawan',$id)->first();
        $user = Auth::user();
        return view('pages/karyawan/v_edit_karyawan')->with(['data'=>$data,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = Auth::user();
        $no = 1;
        $data = Karyawan::where('id_karyawan',$id);
        $data_update=[
            'name_karyawan' => $request->input('name_karyawan'),
        ];

        $validator = Validator::make($request->all(), [
            'name_karyawan' => 'required',
        ],[
            'name_karyawan.required' => 'Nama wajib diisi.'
        ]);

        if ($validator->fails()) {
        $pesan = 'Gagal diubah';
        return view("pages/karyawan/v_karyawan")->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);

        }else{
            $data = HRD::orderBy('id_karyawan','asc')->paginate(10);
        Karyawan::where('id_karyawan',$id)->update($data_update);
        $pesan = 'Berhasil diubah';
        return view("pages/karyawan/v_karyawan")->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pesan = 'Berhasil dihapus';
        $data = Karyawan::orderBy('name_karyawan','asc')->paginate(10);
        $no = 1;
        $user = Auth::user();
        $checkdata = Karyawan::where('id_karyawan', $id)->first();
        $validator = Validator::make( [
            'id_karyawan' => 'unique:detail_absensi',
        ],[
            'id_karyawan.unique' => 'Kode sudah terdaftar.',
        ]);
        if($validator){
            $pesan = 'Silahkan cek kembali data yang akan dihapus pada data yang lain!';
            return view("pages/karyawan/v_karyawan")->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);
        }else if($checkdata){
            Karyawan::where('id_karyawan',$id)->delete();
            return view("pages/karyawan/v_karyawan")->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }else{
            // dd($id);
            $pesan = 'Data tidak ditemukan';
            return view("pages/karyawan/v_karyawan")->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);
        }
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = Karyawan::where('name', 'like', "%$searchTerm%")->paginate(5);
        return view('karyawan.search', ['users' => $users]);
    }

    //import karyawan
    public function importexcel(Request $request){
        $data = $request->file('file_excel');

        $data = $request->file('file_excel');
            if (!$data) {
                $pesan = 'File belum dipilih.';
                return redirect()->back()->withErrors($pesan);
            }

        $namafile = $data->getClientOriginalName();
        $data->move('KaryawanData',$namafile);

        $path = public_path('/KaryawanData/'.$namafile);
        $import = new KaryawanImport;
        $rows = Excel::toArray($import, $path);
        $data_isi = Karyawan::orderBy('name_karyawan','asc')->paginate(10);
        $no = 1;
        $user = Auth::user();

            foreach ($rows[0] as $row) {
                // Sesi pemeriksaan
                $id_karyawan = $row[0];
                $checkdata = Karyawan::where('id_karyawan', $id_karyawan)->first();
                if ($checkdata) {
                    $pesan = 'Data sudah ada silahkan cek kembali!!';
                    return view("pages/karyawan/v_karyawan")->with(['data'=>$data_isi,'no'=>$no,'user'=>$user])->withErrors($pesan);
                } else {
                    if ($id_karyawan == null) {
                        $pesan = 'Kode Karyawan tidak boleh kosong!';
                        return redirect()->back()->with(['data' => $data_isi, 'no' => $no, 'user' => $user])->withErrors($pesan);
                    }
                    //sesi berhasil
                    $pesan = 'Berhasil diimport';
                    Excel::import(new KaryawanImport, \public_path('/KaryawanData/'.$namafile));
                    return view("pages/karyawan/v_karyawan")->with(['data'=>$data_isi,'isipesan'=>$pesan,'no'=>$no,'user'=>$user]);
                }
            }
    }

}
