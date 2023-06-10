<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $data = User::orderBy('id','asc')->paginate(10);
        $no = 1;
        return view("pages/user/v_user")->with(['user' => $user,'data'=>$data,'no'=>$no]);
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = Auth::user();
        $data_update=[
            'name' => $request->input('name'),
            'level' => $request->input('level'),
            'password' => Hash::make($request->input('password')),
        ];

        if ($validator->fails()) {
        $user = Auth::user();
        $data = User::orderBy('id','asc')->paginate(10);
        $no = 1;
        $pesan = 'Gagal diubah';
        return view("pages/user/v_user")->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);

        }else{
            User::where('id',$id)->update($data_update);
            $pesan = 'Berhasil diubah';
            $data = User::orderBy('id','asc')->paginate(10);
            $no = 1;
        return view("pages/user/v_user")->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
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
