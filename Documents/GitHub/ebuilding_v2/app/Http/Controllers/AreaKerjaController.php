<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use App\Models\AreaKerja;
use App\Models\Kategori;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AreaKerjaController extends Controller
{

    public function index()
    {
        $area = AreaKerja::get();
        return view('pages.gedung.area_kerja.show', compact('area'));
    }

    public function create()
    {
        $kategori = Kategori::get();
        $gedung   = Gedung::get();
        return view('pages.gedung.area_kerja.create', compact('kategori','gedung'));
    }

    public function store(Request $request)
    {
        $tambah = new AreaKerja();
        $tambah->kategori_id     = $request->kategori_id;
        $tambah->gedung_id       = $request->gedung_id;
        $tambah->nama_area_kerja = $request->nama_area_kerja;
        $tambah->keterangan      = $request->keterangan;
        $tambah->created_at      = Carbon::now();
        $tambah->save();

        return redirect()->route('area_kerja.show')->with('success', 'Berhasil menambah area kerja');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $gedung = Gedung::get();
        $area   = AreaKerja::where('id_area_kerja', $id)->first();
        return view('pages.gedung.area_kerja.create', compact('gedung','area'));
    }

    public function update(Request $request, $id)
    {
        AreaKerja::where('id_gedung', $id)->update([
            'kategori_id'     => $request->kategori_id,
            'gedung_id'       => $request->gedung_id,
            'nama_area_kerja' => $request->nama_area_kerja,
            'keterangan'      => $request->keterangan
        ]);

        return redirect()->route('area_kerja.show')->with('success', 'Berhasil menyimpan perubahan');
    }

    public function destroy($id)
    {
        AreaKerja::where('id_area_kerja', $id)->delete();
        return redirect()->route('area_kerja.show')->with('success', 'Berhasil menghapus');
    }

    public function selectByCategory($id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        if ($pegawai->kategori_id == 4)
        {
            $areaKerja = AreaKerja::join('t_gedung','id_gedung','gedung_id')->get();
        } else {
            $areaKerja = AreaKerja::join('t_gedung','id_gedung','gedung_id')->where('kategori_id', '0')->get();
        }

        return response()->json($areaKerja);
    }
}
