<?php

namespace App\Http\Controllers;

use App\Models\Penyedia;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PenyediaController extends Controller
{
    public function index()
    {
        $penyedia = Penyedia::get();
        return view('pages.penyedia.show', compact('penyedia'));
    }

    public function create()
    {
        return view('pages.penyedia.create');
    }

    public function store(Request $request)
    {
        $tambah = new Penyedia();
        $tambah->nama_penyedia = strtoupper($request->nama_penyedia);
        $tambah->created_at    = Carbon::now();
        $tambah->save();

        return redirect()->route('penyedia.show')->with('success', 'Berhasil menambah data');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $penyedia = Penyedia::where('id_penyedia', $id)->first();
        return view('pages.penyedia.edit', compact('penyedia'));
    }

    public function update(Request $request, $id)
    {
        Penyedia::where('id_penyedia', $id)->update([
            'nama_penyedia' => $request->nama_penyedia
        ]);

        return redirect()->route('penyedia.show')->with('success', 'Berhasil menyimpan perubahan');
    }

    public function destroy($id)
    {
        Penyedia::where('id_penyedia',$id)->delete();

        return redirect()->route('penyedia.show')->with('success', 'Berhasil Menghapus');
    }
}
