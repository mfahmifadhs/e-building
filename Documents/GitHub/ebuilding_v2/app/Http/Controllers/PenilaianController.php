<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\KriteriaPenilaian;
use App\Models\Penilaian;
use App\Models\PenilaianDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;

class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $listKategori = Kategori::orderBy('nama_kategori','ASC');
        $penilaian    = Penilaian::orderBy('t_penilaian.created_at', 'DESC');
        $bulan        = [];
        $bulanPick    = [];
        $kategoriPick = [];

        for ($i = 1; $i <= 12; $i++) {
            $listBulan[] = [
                'id'         => $i,
                'nama_bulan' => Carbon::now()->locale('id')->month($i)->isoFormat('MMMM')
            ];
        }
        // filter
        if($request->bulan || $request->kategori) {
            if ($request->bulan) {
                $selectedBulan = explode(',', $request->bulan);
                $bulan = collect($listBulan)->where('id', '!=', $request->bulan)->all();
                $bulanPick = collect($listBulan)->filter(function ($item) use ($selectedBulan) {
                    return in_array($item['id'], $selectedBulan);
                });

                $search = $penilaian->where(DB::raw("DATE_FORMAT(t_penilaian.created_at, '%c')"), $request->bulan);
            } else { $bulan    = $listBulan; }


            if ($request->kategori) {
                $search       = $penilaian->join('t_pegawai','id_pegawai','pegawai_id')->where('kategori_id', $request->kategori);
                $kategori     = $listKategori->where('id_kategori','!=',$request->kategori)->get();
                $kategoriPick = Kategori::where('id_kategori', $request->kategori)->first();
            } else { $kategori = $listKategori->get(); }


            $temuan   = $search->get();
            $tab      = 2;
        } else {
            $kategori  = $listKategori->get();
            $bulan     = $listBulan;
            $temuan    = $penilaian->get();
        }

        return view('pages.penilaian.show', compact('kategori','temuan','bulan','bulanPick','kategoriPick'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $format  = str_pad(Penilaian::count() + 1, 4, 0, STR_PAD_LEFT);
        $id      = Carbon::now()->isoFormat('YYMMDD') . $format;

        $tambah = new Penilaian();
        $tambah->id_penilaian  = $id;
        $tambah->pengawas_id   = Auth::user()->id;
        $tambah->pegawai_id    = $request->pegawai_id;
        $tambah->area_kerja_id = $request->area_kerja_id;
        $tambah->created_at    = Carbon::now();
        $tambah->save();

        $detail = $request->temuan;
        foreach ($detail as $i => $kriteria_id) {
            if ($kriteria_id) {
                $detail = new PenilaianDetail();
                $detail->penilaian_id  = $id;
                $detail->kriteria_id   = $request->kriteria[$i];
                $detail->keterangan    = $request->keterangan[$i];
                $detail->created_at    = Carbon::now();
                $detail->save();
            }
        }

        return redirect()->route('dashboard')->with('success', 'Berhasil membuat penilaian');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $temuan   = Penilaian::where('id_penilaian', $id)->first();
        $kriteria = KriteriaPenilaian::where('kategori_id', $temuan->pegawai->kategori_id)->get();

        return view('pages.penilaian.edit', compact('id', 'temuan', 'kriteria'));
    }

    public function update(Request $request, $id)
    {
        Penilaian::where('id_penilaian', $id)->update([
            'pengawas_id'   => $request->pengawas_id,
            'pegawai_id'    => $request->pegawai_id,
            'area_kerja_id' => $request->area_kerja_id
        ]);

        $kriteria = $request->kriteria;
        foreach ($kriteria as $i => $kriteria_id) {
            if ($request->temuan[$i] == true) {
                PenilaianDetail::where('id_detail', $request->detail[$i])->update([
                    'penilaian_id'  => $id,
                    'kriteria_id'   => $kriteria_id,
                    'keterangan'    => $request->keterangan[$i]

                ]);

                if (PenilaianDetail::where('id_detail', $request->detail[$i])->count() == 0) {
                    $detail = new PenilaianDetail();
                    $detail->penilaian_id  = $id;
                    $detail->kriteria_id   = $kriteria_id;
                    $detail->keterangan    = $request->keterangan[$i];
                    $detail->created_at    = Carbon::now();
                    $detail->save();
                }
            }

            if ($request->temuan[$i] == false) {
                PenilaianDetail::where('id_detail', $request->detail[$i])->update([
                    'deleted_at'    => Carbon::now()
                ]);
            }
        }

        return redirect()->route('penilaian.edit', $id)->with('success', 'Berhasil menyimpan perubahan');
    }

    public function destroy($id)
    {
        Penilaian::where('id_penilaian', $id)->delete();
        return redirect()->route('penilaian.show')->with('success', 'Berhasil menghapus penilaian');
    }

    public function showLaporan()
    {
        $kriteria = KriteriaPenilaian::get();
        $temuan   = Penilaian::get();

        return view('pages.penilaian.laporan.show', compact('kriteria','temuan'));
    }
}
