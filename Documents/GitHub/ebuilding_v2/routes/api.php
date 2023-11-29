<?php

use App\Http\Controllers\Api\AreaKerjaController;
use App\Http\Controllers\Api\PegawaiController;
use App\Http\Controllers\Api\PenilaianController;
use App\Http\Controllers\Api\PosisiController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:api'], function () {

    Route::get('user', [UserController::class, 'index']);
    Route::get('penilaian/{pengawasId}', [PenilaianController::class, 'getScore']);
    Route::get('penilaian/peringkat/{pengawasId}', [PenilaianController::class, 'getRank']);
    Route::get('penilaian/detail/{scoreId}', [PenilaianController::class, 'getDetail']);

    Route::get('pegawai/{vendorId}', [PegawaiController::class, 'getByVendor']);
    Route::get('area-kerja/{id}', [AreaKerjaController::class, 'getWorkareaByEmployee']);
    Route::get('posisi', [PosisiController::class, 'getPosition']);

    Route::post('penilaian/tambah', [PenilaianController::class, 'postScore']);

});

Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

