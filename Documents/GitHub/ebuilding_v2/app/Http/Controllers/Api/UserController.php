<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UnitKerja;
use App\Models\Role;
use App\Models\Status;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index ()
    {
        $user = User::get();
        return response()->json([ 'success' => true, 'user' => $user ], 200);
    }

    public function create()
    {
        $role    = Role::get();
        $pegawai = Pegawai::get();
        $status  = Status::get();

        return response()->json([
            'success' => true,
            'role' => $role,
            'pegawai' => $pegawai,
            'status' => $status
        ], 200);
    }

    public function store(Request $request)
    {
        $format  = str_pad(Pegawai::count() + 1, 3, 0, STR_PAD_LEFT);
        $id      = Carbon::now()->isoFormat('YYMMDD').$format;
        $pegawai = Pegawai::where('id_pegawai', $request->pegawai_id)->first();

        $tambah = new User();
        $tambah->id             = $id;
        $tambah->role_id        = $request->role_id;
        $tambah->pegawai_id     = $request->pegawai_id;
        $tambah->username       = $pegawai->nip;
        $tambah->password       = Hash::make($request->password);
        $tambah->password_teks  = $request->password;
        $tambah->status_id      = $request->status_id;
        $tambah->save();

        return response()->json([ 'success' => 'Berhasil Menambah User Baru'], 200);
    }

    public function detail($id)
    {
        $user = User::where('id', $id)->first();
        return response()->json([ 'success' => true, 'user' => $user ], 200);
    }

    public function edit($id)
    {
        $status  = Status::get();
        $role    = Role::get();
        $pegawai = Pegawai::get();
        $user    = User::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'role'    => $role,
            'pegawai' => $pegawai,
            'status'  => $status,
            'user'    => $user
        ], 200);
    }

    public function update(Request $request, $id)
    {
        User::where('id', $id)->update([
            'role_id'        => $request->role_id,
            'password'       => Hash::make($request->password),
            'password_teks'  => $request->password,
            'status_id'      => $request->status_id
        ]);

        return response()->json([ 'success' => 'Berhasil Menyimpan Perubahan' ], 200);
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return response()->json([ 'success' => 'Berhasil Menghapus Data' ], 200);
    }
}
