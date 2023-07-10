<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Karyawan;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $user = Auth::user();
        $data = User::where('id',$id)->first();
        $karyawan = Karyawan::where('id_karyawan',$user->username)->first();
        return view('pages/profile/profile')->with(['data'=>$data,'user'=>$user,'karyawan'=>$karyawan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = Auth::user();
        $data = User::orderBy('id','asc')->paginate(10);
        $no = 1;
        $data_update=[
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];
        $nama_update=[
            'name' => $request->input('name'),
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ],[
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
        ]);
       

        if ($validator->fails()) {
        return redirect()->back()->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($validator);

        }else{
            User::where('username',$id)->update($data_update);
            $pesan = 'Profile berhasil diubah';
        return redirect()->back()->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
