<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    //masuk
    public function index(){
        return view("pages/v_login");
    }

    //session login
    public function login(Request $request){

        Session::flash('username',$request->username);
        Session::flash('password',$request->password);
        $pass = Hash::make($request->password);
        $infologin = [
            'username' => $request->username,
            'password' => $pass
        ];
        $infologin2 = $request->only('username', 'password');
        if(Auth::attempt($infologin2)){
            //berhasil
            // $username_login = $request->input('username');
            // return view('pages/v_login');
            $pesan = 'Username atau Password benar !!';
            return redirect('/')->with(['pesan'=>$pesan]);
            // echo 'berhasil';
              
        }else{
            //gagal
            $infologin2 = $request->only('username', 'password');
        $pesan = 'Username atau Password salah !!';
        //   return view('pages/v_login')->with(['pesan'=>$pesan]);
        //   return dd($infologin2);
        dd(Auth::attempt($infologin2));
        }
    }

    //session logout
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
