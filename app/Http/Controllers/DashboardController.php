<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(Request $request){
        $username_login = $request->session()->get('username_login');
        $user = Auth::user();
        return view("pages/v_dashboard")->with(['user' => $user]);
    }
}
