<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\KriteriaPenilaian;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KriteriaPenilaianController extends Controller
{

    public function index()
    {
        $kriteria = KriteriaPenilaian::get();
        return view('pages.penilaian.kriteria.show', compact('kriteria'));
    }

    public function create()
    {
        $kategori = Kategori::get();
        return view('pages.penilaian.kriteria.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $tambah = new KriteriaPenilaian();
        $tambah->kategori_id   = $request->kategori_id;
        $tambah->nama_kriteria = $request->nama_kriteria;
        $tambah->created_at    = Carbon::now();
        $tambah->save();

        return redirect()->route('kriteria.show')->with('success', 'Berhasil menambah kriteria baru');
    }

    public function show($id)
    {
        $kriteria = KriteriaPenilaian::where('id_kriteria', $id)->first();
        return view('pages.penilaian.kriteria.detail', compact('kriteria'));
    }

    public function edit($id)
    {
        $kategori = Kategori::get();
        $kriteria = KriteriaPenilaian::where('id_kriteria', $id)->first();
        return view('pages.penilaian.kriteria.edit', compact('kategori','kriteria'));
    }

    public function update(Request $request, $id)
    {
        KriteriaPenilaian::where('id_kriteria', $id)->update([
            'kategori_id'   => $request->kategori_id,
            'nama_kriteria' => $request->nama_kriteria
        ]);
        return redirect()->route('kriteria.show')->with('success', 'Berhasil menyimpan perubahan');
    }

    public function destroy($id)
    {
        KriteriaPenilaian::where('id_kriteria',$id)->delete();

        return redirect()->route('kriteria.show')->with('success', 'Berhasil menghapus kriteria');
    }

    public function info($id)
    {
        $pegawai  = Pegawai::where('id_pegawai', $id)->first();
        $kriteria = KriteriaPenilaian::where('kategori_id', $pegawai->kategori_id)->get();
        return response()->json($kriteria);
    }
}
