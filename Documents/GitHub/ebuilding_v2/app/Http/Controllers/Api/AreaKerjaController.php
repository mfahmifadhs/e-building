<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AreaKerja;

class AreaKerjaController extends Controller
{
    public function getWorkareaByEmployee($id)
    {
        $area = AreaKerja::orderBy('nama_area_kerja', 'ASC')
        ->join('t_gedung','id_gedung','gedung_id')
        ->where('kategori_id', $id)
        ->get();

        return response()->json([ 'success' => true, 'area' => $area ], 200);
    }
}
