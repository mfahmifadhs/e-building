<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAccessModel;
use Auth;
use Hash;
use Session;
use DB;


class AuthController extends Controller
{
    public function index()
    {
        return view ('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'username'    => 'required',
            'password'    => 'required',
        ]);
   
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->with('success','Selamat anda berhasil masuk !');
        }
  
        return redirect("login")->with('failed', 'Username atau Password Salah !');
    }



    public function registration()
    {
        return view('auth.registration');
    }
      

    public function customRegistration(Request $request)
    {  
        $username = $request->username;
        $cekusername = DB::table('tbl_users')->where('username', $username)->count();
        if ($cekusername == 1) {
            return redirect("admin-master/create_user")->with('failed', 'Username sudah terdaftar!');
        }else{
            $request->validate([
                'name'      => 'required',
                'role_id'   => 'required',
                'username'  => 'required|unique:tbl_users',
                'password'  => 'required|min:6',
                'status_id' => 'required'
            ]);

            $data = $request->all();
            $check = $this->create($data);

            $user_id  = DB::table('tbl_users')->select('id')->orderby('id', 'DESC')->first();
            $accessid = DB::table('tbl_users_access')->count(); 
            $user_access                        = new UserAccessModel();
            $user_access->id_user_access        = $accessid+1;
            $user_access->user_id               = $user_id->id;
            $user_access->is_banquet_multimedia = $request->input('is_banquet_multimedia');
            $user_access->is_cleaning_service   = $request->input('is_cleaning_service');
            $user_access->is_gardener           = $request->input('is_gardener');
            $user_access->is_security           = $request->input('is_security');
            $user_access->save();

            if ($request->role_id == 2) {
                return redirect("admin-master/show_vendor")->with('success', 'Pengguna Berhasil Di Daftarkan');
            }else{
                return redirect("admin-master/show_pengawas")->with('success', 'Pengguna Berhasil Di Daftarkan');
            }
        }
        
    }


    public function create(array $data)
    {
      $userid = DB::table('tbl_users')->count();
      return User::create([
        'id'        => $userid+1,
        'name'      => $data['name'],
        'role_id'   => $data['role_id'],
        'username'  => $data['username'],
        'password'  => Hash::make($data['password']),
        'status_id' => $data['status_id']
        
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check() && Auth::user()->role_id == 1 && Auth::user()->status_id == 1){
            return redirect('admin-master/dashboard')->with('success','Selamat anda berhasil masuk !');
        }elseif (Auth::check() && Auth::user()->role_id == 2 && Auth::user()->status_id == 1) {
            return redirect('vendor/dashboard')->with('success','Selamat anda berhasil masuk !');
        }elseif (Auth::check() && Auth::user()->role_id == 3 && Auth::user()->status_id == 1) {
            return redirect('pengawas/dashboard')->with('success','Selamat anda berhasil masuk !');
        }
  
        return redirect("login")->with('failed', 'Anda tidak memiliki akses!');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
