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
use App\Imports\UserImport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();
        $search = request()->input('search');
        $data = User::orderBy('id', 'asc')->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%'.$search.'%')
                  ->orWhere('email', 'LIKE', '%'.$search.'%')
                  ->orWhere('username', 'LIKE', '%'.$search.'%');
        })->paginate(5);
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
        $validator = Validator::make($request->all(), [
            'username' => 'unique:users',
            'email' => 'unique:users',
            'password' => 'min:6|confirmed',
        ],[
            'username.unique' => 'Username sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Password tidak sesuai'
        ]);

        $data = [
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'level' => $request->input('level'),
        ];

        if ($validator->fails()) {
            $user = Auth::user();
            $data = User::orderBy('id','asc')->paginate(10);
            $no = 1;
            return view('pages/user/v_user')->withErrors($validator)->with(['user' => $user,'data'=>$data,'no'=>$no]);

        }else{
            User::create($data);
            $pesan = 'Berhasil ditambahkan';
            $user = Auth::user();
            $data = User::orderBy('id','asc')->paginate(10);
            $no = 1;
            return view('pages/user/v_user')->with(['isipesan'=>$pesan,'user' => $user,'data'=>$data,'no'=>$no]);
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
        $data = User::where('id',$id)->first();
        $user = Auth::user();
        return view('pages/user/v_edit_user')->with(['data'=>$data,'user'=>$user]);
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
            'email' => $request->input('email'),
            'level' => $request->input('level'),
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'sometimes|required|min:6',
        ],[
            'name.required' => 'Nama wajib diisi.'
        ]);

        $validator->sometimes('password', 'hash', function ($input) use ($request) {
            return $request->has('password') && $input['password'] !== $request->input('password');
        });
        

        if ($validator->fails()) {
        $user = Auth::user();
        $data = User::orderBy('id','asc')->paginate(10);
        $no = 1;
        $pesan = 'Gagal diubah';
        return view("pages/user/v_user")->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);

        }else{
            if ($request->filled('password')) {
                $data_update['password'] = ($request->input('password') !== $user->password)
                    ? Hash::make($request->input('password'))
                    : $data_update['password'];
            } else {
                unset($data_update['password']);
            }
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
        
        $pesan = 'Berhasil dihapus';
        $data = User::orderBy('id','asc')->paginate(10);
        $no = 1;
        $user = Auth::user();
        $checkdata = User::where('username', $id)->first();
        if($checkdata){
            User::where('username',$id)->delete();
            return view("pages/user/v_user")->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
        }else{
            $pesan = 'Data tidak ditemukan';
            return view("pages/user/v_user")->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);
        }
    }

    //import user
    public function importexcel(Request $request){
            $data = $request->file('file_excel');

            $data = $request->file('file_excel');
                if (!$data) {
                    $pesan = 'File belum dipilih.';
                    return redirect()->back()->withErrors($pesan);
                }

            $namafile = $data->getClientOriginalName();
            $data->move('UserData',$namafile);

            $path = public_path('/UserData/'.$namafile);
            $import = new UserImport;
            $rows = Excel::toArray($import, $path);
            $data_isi = User::orderBy('id','asc')->paginate(10);
            $no = 1;
            $user = Auth::user();

                foreach ($rows[0] as $row) {
                    // Sesi pemeriksaan
                    $username = $row[0];
                    $email = $row[2];
                    $checkdata = User::where('username', $username)->first();
                    $checkemail = User::where('email', $email)->first();
                    if ($checkdata || $checkemail) {
                        $pesan = 'Data sudah ada silahkan cek kembali!!';
                        return view("pages/user/v_user")->with(['data'=>$data_isi,'no'=>$no,'user'=>$user])->withErrors($pesan);
                    } else {
                        if ($username == null) {
                            $pesan = 'Username tidak boleh kosong!';
                            return redirect()->back()->with(['data' => $data_isi, 'no' => $no, 'user' => $user])->withErrors($pesan);
                        }
                        //sesi berhasil
                        $pesan = 'Berhasil diimport';
                        Excel::import(new UserImport, \public_path('/UserData/'.$namafile));
                        return view("pages/user/v_user")->with(['data'=>$data_isi,'isipesan'=>$pesan,'no'=>$no,'user'=>$user]);
                    }
                }
        }
        
         //ubah password
    public function UbahPassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'min:6|confirmed',
        ],[
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Password tidak sesuai'
        ]);

        $data_update=[
            'password' => Hash::make($request->input('password')),
        ];

        $user = Auth::user();
        $data = User::orderBy('id','asc')->paginate(10);
        $no = 1;

        if ($validator->fails()) {
            $pesan = 'Gagal diubah';
            return view("pages/user/v_edit_user")->with(['user' => $user,'data'=>$data,'no'=>$no])->withErrors($pesan);
    
            }else{
                User::where('id',$id)->update($data_update);
                $pesan = 'Berhasil diubah';
            return view("pages/user/v_edit_user")->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
            }
    }

        //reset password
        public function resetPassword(Request $request, $id){
            {
                $user = User::find($id);
                $user->password = Hash::make($user->username);
                $user->save();

                $user = Auth::user();
                $data = User::orderBy('id','asc')->paginate(10);
                $no = 1;
                $pesan = 'Berhasil direset';
            return view("pages/user/v_user")->with(['data'=>$data, 'no'=>$no,'user'=>$user,'isipesan'=>$pesan]);
            }
    }

    public function search(Request $request)
            {
                $searchTerm = $request->input('search');

                // Lakukan pencarian atau tindakan lain sesuai kebutuhan
                // Contoh: Query untuk mencari data pengguna berdasarkan kata kunci
                $users = User::where('name', 'like', "%$searchTerm%")->paginate(5);

                // Mengembalikan tampilan atau data JSON sesuai kebutuhan
                return view('user.search', ['users' => $users]);
            }

}

    
    