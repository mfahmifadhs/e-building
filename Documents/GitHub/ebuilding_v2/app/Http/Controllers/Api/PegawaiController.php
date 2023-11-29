<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Penyedia;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PegawaiController extends Controller
{
    public function getByVendor($vendorId)
    {
        $pegawai = Pegawai::where('penyedia_id', $vendorId)->get();
        return response()->json([ 'success' => true, 'pegawai' => $pegawai ], 200);
    }

}
