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


class PassController extends Controller
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
         //realtime WIB
         $now = Carbon::now(new DateTimeZone('Asia/Jakarta'));
         $timeWIB = $now->format('H:i');
        $data_update=[
            'password' => Hash::make($request->input('password')),
        ];
        $validator = Validator::make($request->all(), [
            'password' => 'confirmed',
        ],[
            'password.confirmed' => 'Password tidak sesuai',
        ]);
        if ($validator->fails()) {
           
        return redirect()->back()->with(['user' => $user,'data'=>$data])->withErrors($validator);

        }else{
            User::where('username',$id)->update($data_update);
            $username_login = $request->session()->get('username_login');
            $user = Auth::user();
            $pesan='Berhasil ubah password';
        return redirect('/dashboard')->with(['user' => $user,'isipesan'=>$pesan,'time'=>$timeWIB]);
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
