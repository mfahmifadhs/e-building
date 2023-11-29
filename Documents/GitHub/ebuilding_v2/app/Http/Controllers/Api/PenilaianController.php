<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\KriteriaPenilaian;
use App\Models\Penilaian;
use App\Models\PenilaianDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;

class PenilaianController extends Controller
{
    public function getRankAll()
    {

    }
    public function getRank($id)
    {
        $user  = User::where('id', $id)->first();

        $score = PenilaianDetail::join('t_penilaian', 'id_penilaian', 'penilaian_id')
        ->join('t_pegawai','id_pegawai','pegawai_id')
        ->join('t_kategori','id_kategori','kategori_id')
        ->join('t_penyedia','id_penyedia','penyedia_id')
        ->select('pegawai_id','nama_pegawai','nama_kategori','nama_penyedia', \DB::raw('COUNT(t_penilaian_detail.id_detail) as total_nilai'))
        ->groupBy('pegawai_id','nama_pegawai','nama_kategori','nama_penyedia')
        ->orderBy('total_nilai', 'DESC');

        if ($user->role_id == 4) {
            $result = $score->where('pengawas_id', $id)->get();
        } else {
            $result = $score->get();
        }

        return response()->json([ 'success' => true, 'score' => $result ], 200);
    }

    public function getScore($id)
    {
        $user  = User::where('id', $id)->first();

        $score = PenilaianDetail::join('t_penilaian', 'id_penilaian', 'penilaian_id')
        ->select('t_penilaian.created_at as tanggal','nama_pegawai','nama_kategori','nama_penyedia',
        \DB::raw('COUNT(t_penilaian_detail.id_detail) as total_nilai'))
        ->join('t_area_kerja','id_area_kerja','area_kerja_id')
        ->join('t_gedung','id_gedung','gedung_id')
        ->join('t_pegawai','id_pegawai','pegawai_id')
        ->join('t_kategori','id_kategori','t_pegawai.kategori_id')
        ->join('t_penyedia','id_penyedia','penyedia_id')
        ->groupBy('penilaian_id','nama_pegawai','nama_kategori','nama_penyedia','tanggal')
        ->orderBy('total_nilai', 'DESC');

        if ($user->role_id == 4) {
            $result = $score->where('pengawas_id', $id)->get();
        } else {
            $result = $score->get();
        }

        if (!$result) {
            return response()->json([ 'success' => true, 'score' => $result ], 200);
        } else {
            return response()->json([ 'success' => true, 'score' => $result ], 200);
        }
    }

    public function getDetail($scoreId)
    {
        $detail = PenilaianDetail::where('penilaian_id', $scoreId)
        ->join('t_kriteria_penilaian','id_kriteria','kriteria_id')->get();
        return response()->json([ 'success' => true, 'detail' => $detail ], 200);

    }

    public function postScore(Request $request)
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
                $detail->kriteria_id   = (int) $request->kriteria[$i];
                $detail->keterangan    = $request->keterangan[$i];
                $detail->created_at    = Carbon::now();
                $detail->save();
            }
        }

        return response()->json([ 'success' => 'Berhasil Menambah Penilaian' ], 200);
    }

    public function updateScore(Request $request, $id)
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
                $detail->kriteria_id   = (int) $request->kriteria[$i];
                $detail->keterangan    = $request->keterangan[$i];
                $detail->created_at    = Carbon::now();
                $detail->save();
            }
        }

        return response()->json([ 'success' => 'Berhasil Menambah Penilaian' ], 200);
    }
}
