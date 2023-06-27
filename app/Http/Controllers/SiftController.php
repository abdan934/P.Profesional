<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sift;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Imports\SiftImport;
use Maatwebsite\Excel\Facades\Excel;

class SiftController extends Controller
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
        $data = Sift::orderBy('id_sift', 'asc')->where(function ($query) use ($search) {
            $query->where('id_sift', 'LIKE', '%'.$search.'%')
                  ->orWhere('name_sift', 'LIKE', '%'.$search.'%')
                  ->orWhere('waktu_awal', 'LIKE', '%'.$search.'%')
                  ->orWhere('waktu_akhir', 'LIKE', '%'.$search.'%');
        })->paginate(5);
        return view("pages/sift/v_sift")->with(['user' => $user,'data'=>$data,'no'=>$no]);
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
            'id_sift' => 'unique:sift',
        ],[
            'id_sift.unique' => 'Kode sudah terdaftar.',
        ]);

        $datacreate = [
            'id_sift' => $request->input('id_sift'),
            'name_sift' => $request->input('name_sift'),
            'waktu_awal' => $request->input('waktu_awal'),
            'waktu_akhir' => $request->input('waktu_akhir'),
        ];

        $user = Auth::user();
        $data = Sift::orderBy('id_sift','asc')->paginate(10);
        $no = 1;

        if ($validator->fails()) {
            
            return redirect()->back()->withErrors($validator)->with(['user' => $user,'data'=>$data,'no'=>$no]);

        }else{
            Sift::create($datacreate);
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
        $data = Sift::where('id_sift',$id)->first();
        $user = Auth::user();
        return view('pages/sift/v_edit_sift')->with(['data'=>$data,'user'=>$user]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = Auth::user();
        $no = 1;
        $data = Sift::where('id_sift',$id);
        $data_update=[
            'name_sift' => $request->input('name_sift'),
            'waktu_awal' => $request->input('waktu_awal'),
            'waktu_akhir' => $request->input('waktu_akhir'),
        ];

        $validator = Validator::make($request->all(), [
            'name_sift' => 'required',
            'waktu_awal' => 'required',
            'waktu_akhir' => 'required',
        ],[
            'name_sift.required' => 'Nama wajib diisi.',
            'waktu_awal.required' => 'Waktu awal wajib diisi.',
            'waktu_akhir.required' => 'Waktu akhir wajib diisi.'
        ]);

        if ($validator->fails()) {
        $pesan = 'Gagal diubah';
        return redirect()->back()->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);

        }else{
            $data = Sift::orderBy('id_sift','asc')->paginate(10);
        Sift::where('id_sift',$id)->update($data_update);
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
        $data = Sift::orderBy('name_sift','asc')->paginate(10);
        $no = 1;
        $user = Auth::user();
        $checkdata = Sift::where('id_sift', $id)->first();
        if($checkdata){
            Sift::where('id_sift',$id)->delete();
            return redirect()->back()->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }else{
            $pesan = 'Data tidak ditemukan';
            return redirect()->back()->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);
        }
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $users = Sift::where('name', 'like', "%$searchTerm%")->paginate(5);
        return view('sift.search', ['users' => $users]);
    }
}
