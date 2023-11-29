<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pegawai;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role_id == 4)
        {
            $listKategori = Kategori::orderBy('nama_kategori','ASC');
            $pegawai   = Pegawai::get();
            $penilaian = Penilaian::where('pengawas_id', Auth::user()->id);
            $bulan     = [];
            $bulanPick = [];
            $kategoriPick = [];
            $tab       = 1;

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

            return view('pages.dashboard.user.show', compact('tab','kategori','pegawai','temuan','bulan','bulanPick','kategoriPick'));

        } else {
            return view('pages.dashboard.show');
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
