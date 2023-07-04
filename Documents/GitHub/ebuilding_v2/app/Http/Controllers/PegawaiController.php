<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Penyedia;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::get();
        return view('pages.pegawai.show', compact('pegawai'));
    }

    public function create()
    {
        $jabatan   = Jabatan::get();
        $penyedia  = Penyedia::orderBy('nama_penyedia', 'ASC')->get();
        $unitKerja = UnitKerja::orderBy('nama_unit_kerja', 'ASC')->get();
        return view('pages.pegawai.create', compact('unitKerja','penyedia','jabatan'));
    }

    public function store(Request $request)
    {
        $format = str_pad(Pegawai::count() + 1, 3, 0, STR_PAD_LEFT);
        $id     = Carbon::now()->isoFormat('YYMMDD').$format;

        $tambah = new Pegawai();
        $tambah->id_pegawai    = $id;
        $tambah->instansi      = $request->instansi;
        $tambah->penyedia_id   = $request->penyedia_id;
        $tambah->kategori_id   = $request->kategori_id;
        $tambah->unit_kerja_id = $request->unit_kerja_id;
        $tambah->nip           = $request->nip;
        $tambah->nama_pegawai  = $request->nama_pegawai;
        $tambah->jabatan_id    = $request->jabatan_id;
        $tambah->jenis_kelamin = $request->jenis_kelamin;
        $tambah->no_hp         = $request->no_hp;
        $tambah->agama         = $request->agama;
        $tambah->alamat        = $request->alamat;
        $tambah->created_at    = Carbon::now();
        $tambah->save();

        return redirect()->route('pegawai.show')->with('success', 'Berhasil menambah data');
    }

    public function show($id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->first();

        if (!$pegawai) {
            return response()->json(['error' => 'Pegawai tidak ditemukan'], 404);
        }

        return response()->json($pegawai);
    }

    public function edit($id)
    {
        $pegawai   = Pegawai::where('id_pegawai', $id)->first();
        $jabatan   = Jabatan::get();
        $penyedia  = Penyedia::orderBy('nama_penyedia', 'ASC')->get();
        $unitKerja = UnitKerja::orderBy('nama_unit_kerja', 'ASC')->get();

        return view('pages.pegawai.edit', compact('pegawai','unitKerja','penyedia','jabatan'));
    }

    public function update(Request $request, $id)
    {
        Pegawai::where('id_pegawai', $id)->update([
            'instansi'      => $request->instansi,
            'kategori_id'   => $request->kategori_id,
            'unit_kerja_id' => $request->unit_kerja_id,
            'penyedia_id'   => $request->penyedia_id,
            'nip'           => $request->nip,
            'nama_pegawai'  => $request->nama_pegawai,
            'jabatan_id'    => $request->jabatan_id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp'         => $request->no_hp,
            'alamat'        => $request->alamat,
            'status_id'     => $request->status_id
        ]);

        User::where('pegawai_id', $id)->update([
            'nip'   => $request->nip
        ]);

        return redirect()->route('pegawai.edit', $id)->with('success', 'Berhasil menyimpan perubahan');
    }

    public function destroy($id)
    {
        Pegawai::where('id_pegawai',$id)->delete();

        return redirect()->route('pegawai.show')->with('success', 'Berhasil menghapus');
    }

    public function select(Request $request)
    {
        $search = $request->search;

        if($search == ''){
            $pegawai = Pegawai::orderBy('instansi', 'ASC')
                        ->orderBy('nama_pegawai', 'ASC')
                        ->whereDoesntHave('users')
                        ->get();
        }else{
            $pegawai = Pegawai::orderBy('instansi', 'ASC')
                        ->orderBy('nama_pegawai', 'ASC')
                        ->where('nama_pegawai', 'like', '%' .$search . '%')
                        ->whereDoesntHave('users')
                        ->get();
        }

        $response = array();
        foreach($pegawai as $data){
            $instansi = $data->instansi == 'kemenkes' ? $data->unitKerja->nama_unit_kerja : $data->penyedia->nama_penyedia;
            $response[] = array(
                "id"    =>  $data->id_pegawai,
                "text"  =>  strtoupper($instansi.' - '.$data->nama_pegawai)
            );
        }

        return response()->json($response);
    }


    public function selectById($id)
    {
        $pegawai = Pegawai::orderBy('instansi', 'ASC')
                    ->orderBy('nama_pegawai', 'ASC')
                    ->where('kategori_id', $id)
                    ->get();

        return response()->json($pegawai);

    }

}
