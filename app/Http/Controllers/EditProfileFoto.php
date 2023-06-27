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
use Carbon\Carbon;
use DateTimeZone;


class EditProfileFoto extends Controller
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = Auth::user();
        $data = User::orderBy('id','asc')->paginate(10);
        $username_login = $request->session()->get('username_login');
        //realtime WIB
        $now = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        $timeWIB = $now->format('H:i');

        $validator = Validator::make($request->all(), [
            'foto_profile' => 'image|mimes:PNG,jpeg,png,jpg,gif|max:2048',
        ]);
         if ($validator->fails()) {
           $pesan = 'Foto harus menggunakan format gambar';
        return redirect()->back()->with(['user' => $user,'data'=>$data])->withErrors($pesan);

        }else if ($request->hasFile('foto_profile')){
            $request->file('foto_profile')->move('fotoprofile/',$request->file('foto_profile')->getClientOriginalName());
            $nama_foto = ['foto_profile' => $request->file('foto_profile')->getClientOriginalName()];
    
                User::where('username', $id)->update($nama_foto);
            $pesan='Berhasil ubah foto profile';
        return redirect('/dashboard')->with(['user' => $user,'isipesan'=>$pesan,'time'=>$timeWIB]);
        }else{
            $pesan='Foto gagal diubah';
        return redirect('/dashboard')->with(['user' => $user,'time'=>$timeWIB])->withErrors($pesan);
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
