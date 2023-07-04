<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GedungController extends Controller
{
    public function index()
    {
        $gedung = Gedung::get();
        return view('pages.gedung.show', compact('gedung'));
    }

    public function create()
    {
        return view('pages.gedung.create');
    }

    public function store(Request $request)
    {
        $tambah = new Gedung();
        $tambah->nama_gedung    = $request->nama_gedung;
        $tambah->created_at     = Carbon::now();
        $tambah->save();

        return redirect()->route('gedung.show')->with('success', 'Berhasil menambah gedung');
    }

    public function show($id)
    {
        $gedung = Gedung::where('id_gedung', $id)->first();
        return view('pages.gedung.show', compact('gedung'));
    }

    public function edit($id)
    {
        $gedung = Gedung::where('id_gedung', $id)->first();
        return view('pages.gedung.edit', compact('gedung'));
    }

    public function update(Request $request, $id)
    {
        Gedung::where('id_gedung', $id)->update([
            'nama_gedung'   => $request->nama_gedung
        ]);

        return redirect()->route('gedung.show')->with('success', 'Berhasil menyimpan perubahan');
    }

    public function destroy($id)
    {
        Gedung::where('id_gedung', $id)->delete();

        return redirect()->route('gedung.show')->with('success', 'Berhasil menghapus');
    }
}
