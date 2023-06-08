<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:6'
        ],[
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.'
        ]);

        Session::flash('username',$request->username);
        Session::flash('password',$request->password);
        $infologin = [
            'username' => $request->username,
            'password' => $request->password
        ];
        $infologin2 = $request->only('username', 'password');
        if(Auth::attempt($infologin2)){
            //berhasil
            $username_login = $request->input('username');
            $pesan = 'Username atau Password benar !!';
            return view('pages/v_login')->with(['pesan'=>$pesan]);
              
        }else{
            //gagal
        $pesan = 'Username atau Password salah !!';
          return view('pages/v_login')->with(['pesan'=>$pesan]);
        }
    }

    //session logout
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
