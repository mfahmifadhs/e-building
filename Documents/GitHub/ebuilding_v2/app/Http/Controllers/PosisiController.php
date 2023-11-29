<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kategori;

class PosisiController extends Controller
{
    public function getPosition()
    {
        $position = Kategori::get();

        return response()->json([ 'success' => true, 'posisi' => $position ], 200);
    }
}
