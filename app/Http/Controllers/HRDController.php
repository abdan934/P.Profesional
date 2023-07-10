<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\HRD;
use App\Imports\HRDImport;
use Maatwebsite\Excel\Facades\Excel;

class HRDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $search = request()->input('search');
        $data = HRD::orderBy('id_hrd', 'asc')->where(function ($query) use ($search) {
            $query->where('id_hrd', 'LIKE', '%'.$search.'%')
                  ->orWhere('name_hrd', 'LIKE', '%'.$search.'%');
        })->paginate(5);
        $no = 1;
        return view("pages/hrd/v_hrd")->with(['user' => $user,'data'=>$data,'no'=>$no]);
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
            'id_hrd' => 'unique:hrd',
        ],[
            'id_hrd.unique' => 'Kode sudah terdaftar.',
        ]);

        $datacreate = [
            'id_hrd' => $request->input('id_hrd'),
            'name_hrd' => $request->input('name_hrd'),
        ];

        $user = Auth::user();
        $data = HRD::orderBy('id_hrd','asc')->paginate(10);
        $no = 1;

        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->with(['user' => $user,'data'=>$data,'no'=>$no]);

        }else{
            HRD::create($datacreate);
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
        $data = HRD::where('id_hrd',$id)->first();
        $user = Auth::user();
        return view('pages/hrd/v_edit_hrd')->with(['data'=>$data,'user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = Auth::user();
        $no = 1;
        $data = HRD::where('id_hrd',$id);
        $data_update=[
            'name_hrd' => $request->input('name_hrd'),
        ];

        $validator = Validator::make($request->all(), [
            'name_hrd' => 'required',
        ],[
            'name_hrd.required' => 'Nama wajib diisi.'
        ]);

        if ($validator->fails()) {
        $pesan = 'Gagal diubah';
        return redirect()->back()->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);

        }else{
            $data = HRD::orderBy('id_hrd','asc')->paginate(10);
        HRD::where('id_hrd',$id)->update($data_update);
        $pesan = 'Berhasil diubah';
        return redirect()->back()->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $pesan = 'Berhasil dihapus';
        $data = HRD::orderBy('name_hrd','asc')->paginate(10);
        $no = 1;
        $user = Auth::user();
        $checkdata = HRD::where('id_hrd', $id)->first();
        if($checkdata){
            HRD::where('id_hrd',$id)->delete();
            return redirect()->back()->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }else{
            $pesan = 'Data tidak ditemukan';
            return redirect()->back()->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);
        }
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = User::where('name', 'like', "%$searchTerm%")->paginate(5);
        return view('hrd.search', ['users' => $users]);
    }

    //import hrd
    public function importexcel(Request $request){
        $data = $request->file('file_excel');

        $data = $request->file('file_excel');
            if (!$data) {
                $pesan = 'File belum dipilih.';
                return redirect()->back()->withErrors($pesan);
            }

        $namafile = $data->getClientOriginalName();
        $data->move('HRDData',$namafile);

        $path = public_path('/HRDData/'.$namafile);
        $import = new HRDImport;
        $rows = Excel::toArray($import, $path);
        $data_isi = HRD::orderBy('name_hrd','asc')->paginate(10);
        $no = 1;
        $user = Auth::user();

            foreach ($rows[0] as $row) {
                // Sesi pemeriksaan
                $id_hrd = $row[0];
                $checkdata = HRD::where('id_hrd', $id_hrd)->first();
                if ($checkdata) {
                    $pesan = 'Data sudah ada silahkan cek kembali!!';
                    return redirect()->back()->with(['data'=>$data_isi,'no'=>$no,'user'=>$user])->withErrors($pesan);
                } else {
                    if ($id_hrd == null) {
                        $pesan = 'Kode HRD tidak boleh kosong!';
                        return redirect()->back()->with(['data' => $data_isi, 'no' => $no, 'user' => $user])->withErrors($pesan);
                    }
                    //sesi berhasil
                    $pesan = 'Berhasil diimport';
                    Excel::import(new HRDImport, \public_path('/HRDData/'.$namafile));
                    return redirect()->back()->with(['data'=>$data_isi,'isipesan'=>$pesan,'no'=>$no,'user'=>$user]);
                }
            }
    }

}
