<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\PengawasKhususController;
use App\Http\Controllers\VendorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function () {
    
    Route::group(['middleware' => ['role:admin-master','status:aktif'], 'prefix' => 'admin-master', 'as' => 'admin-master.'], function () {
        
        Route::get('dashboard', [AdminController::class, 'index']);
        Route::get('chart_rating_2021', [AdminController::class,'getChartRating2021']);
        Route::get('chart_rating_2022', [AdminController::class,'getChartRating2022']);
        Route::get('create_user', [AdminController::class, 'createUser']);
        Route::get('show_employee/{id}', [AdminController::class, 'showEmployee']);
        Route::get('show_profile/{id}', [AdminController::class, 'showProfile']);
        Route::post('change_profile', [AdminController::class, 'changeProfile']);
        Route::post('change_password', [AdminController::class, 'changePassword']);

        // Criteria
        Route::get('show_criteria', [AdminController::class, 'showCriteria']);

        Route::post('upload_criteria', [AdminController::class, 'uploadCriteria']);
        Route::post('add_criteria', [AdminController::class, 'addCriteria']);
        Route::post('update_criteria/{id}', [AdminController::class, 'updateCriteria']);

        // Working Area
        Route::get('show_working_area', [AdminController::class, 'showWorkingArea']);

        Route::post('upload_working_area', [AdminController::class, 'uploadWorkingArea']);
        Route::post('add_working_area', [AdminController::class, 'addWorkingArea']);
        Route::post('update_working_area/{id}', [AdminController::class, 'updateWorkingArea']);
        Route::post('delete_working_area/{id}', [AdminController::class, 'deleteWorkingArea']);

        // Pengawas & Penyedia
        Route::get('show_pengawas', [AdminController::class, 'showPengawas']);
        Route::get('show_vendor', [AdminController::class, 'showVendor']);
        Route::get('edit_pengawas/{id}', [AdminController::class, 'editPengawas']);
        Route::get('edit_vendor/{id}', [AdminController::class, 'editVendor']);

        Route::post('update_pengawas/{id}', [AdminController::class, 'updatePengawas']);
        Route::post('update_vendor/{id}', [AdminController::class, 'updateVendor']);
        Route::post('delete_pengawas/{id}', [AdminController::class, 'deletePengawas']);

        // Banquet dan Multimedia
        Route::get('show_banquet_mm', [AdminController::class, 'showBanquetMM']);
        Route::get('edit_banquet_mm/{id}', [AdminController::class, 'editBanquetMM']);
        Route::post('upload_banquet_mm', [AdminController::class, 'uploadBanquetMM']);
        Route::post('add_banquet_mm', [AdminController::class, 'addBanquetMM']);
        Route::post('update_banquet_mm/{id}', [AdminController::class, 'updateBanquetMM']);
        Route::post('delete_banquet_mm/{id}', [AdminController::class, 'deleteBanquetMM']);
        Route::post('delete_all_banquetmm', [AdminController::class, 'deleteAllBanquetMM']);

        // Cleaning Services
        Route::get('show_cleaning_service', [AdminController::class, 'showCleaningService']);
        Route::get('edit_cleaning_service/{id}', [AdminController::class, 'editCleaningService']);
        Route::post('add_cleaning_service', [AdminController::class, 'addCleaningService']);
        Route::post('upload_cleaning_service', [AdminController::class, 'uploadCleaningService']);
        Route::post('update_cleaning_service/{id}', [AdminController::class, 'updateCleaningService']);
        Route::post('delete_cleaning_service/{id}', [AdminController::class, 'deleteCleaningService']);
        Route::post('delete_all_cleaning_service', [AdminController::class, 'deleteAllCleaningService']);

        // Gardeners
        Route::get('show_gardener', [AdminController::class, 'showGardener']);
        Route::get('edit_gardener/{id}', [AdminController::class, 'editGardener']);
        Route::post('add_gardener', [AdminController::class, 'addGardener']);
        Route::post('upload_gardener', [AdminController::class, 'uploadGardener']);
        Route::post('update_gardener/{id}', [AdminController::class, 'updateGardener']);
        Route::post('delete_gardener/{id}', [AdminController::class, 'deleteGardener']);
        Route::post('delete_all_gardener', [AdminController::class, 'deleteAllGardener']);
        
        // Security
        Route::get('show_security', [AdminController::class, 'showSecurity']);
        Route::get('edit_security/{id}', [AdminController::class, 'editSecurity']);
        Route::post('add_security', [AdminController::class, 'addSecurity']);
        Route::post('upload_security', [AdminController::class, 'uploadSecurity']);
        Route::post('update_security/{id}', [AdminController::class, 'updateSecurity']);
        Route::post('delete_security/{id}', [AdminController::class, 'deleteSecurity']);
        Route::post('delete_all_security', [AdminController::class, 'deleteAllSecurity']);

        // Score
        Route::post('search_score', [AdminController::class, 'showScoreAll']);
        Route::get('show_score_all', [AdminController::class, 'showScoreAll']);
        Route::get('show_score_person/{id}', [AdminController::class, 'showScorePerson']);
        Route::get('show_score_month_22/{category}/{id}', [AdminController::class, 'showScoreMonth22']);
        Route::get('show_score_month_21/{id}', [AdminController::class, 'showScoreMonth21']);
        Route::get('show_score_person_21/{id}', [AdminController::class, 'showScorePerson21']);
        Route::get('detail_score/{id}', [AdminController::class, 'detailScore']);

        Route::post('delete_score/{id}', [AdminController::class, 'deleteScore']);
        
    }); 

    Route::group(['middleware' => ['role:pengawas','status:aktif'], 'prefix' => 'pengawas', 'as' => 'pengawas.'], function () {
        Route::get('dashboard', [PengawasController::class, 'index']);
        Route::get('chart_cleaning_service', [PengawasController::class,'getChartCS']);
        Route::get('chart_security', [PengawasController::class,'getChartSC']);
        Route::get('chart_banquet_mm', [PengawasController::class,'getChartBM']);
        Route::get('chart_gardener', [PengawasController::class,'getChartGD']);

        Route::post('/get_cleaning_service', [PengawasController::class, 'getCleaningService']);
        Route::post('/get_security', [PengawasController::class, 'getSecurity']);
        Route::post('/get_gardener', [PengawasController::class, 'getGardener']);
        Route::post('/get_banquet_mm', [PengawasController::class, 'getBanquetMM']);

        Route::post('/get_workarea_cs', [PengawasController::class, 'getWorkAreaCs']);
        Route::post('/get_workarea_gd', [PengawasController::class, 'getWorkAreaGd']);
        Route::post('/get_workarea_sc', [PengawasController::class, 'getWorkAreaSc']);
        Route::post('/get_workarea_bm', [PengawasController::class, 'getWorkAreaBm']);
        Route::get('/get_work_area', [PengawasController::class, 'getWorkArea']);
        Route::get('/get_work_area_bm', [PengawasController::class, 'getWorkAreaAllBM']);
        Route::get('/get_emp_category', [PengawasController::class, 'getEmpCategory']);

        Route::get('show_profile', [PengawasController::class, 'showProfile']);
        Route::get('show_pegawai', [PengawasController::class, 'showPegawai']);
        Route::get('show_score', [PengawasController::class, 'showScore']);
        Route::get('show_criteria', [PengawasController::class, 'showCriteria']);
        Route::get('profile', [PengawasController::class, 'showProfile']);
        Route::get('detail_score/{id}', [PengawasController::class, 'detailScore']);

        Route::post('change_profile', [PengawasController::class, 'changeProfile']);
        Route::post('change_password', [PengawasController::class, 'changePassword']);
        Route::post('search_score', [PengawasController::class, 'showScore']);
        Route::post('create_score', [PengawasController::class, 'createScore']);
        Route::post('add_score', [PengawasController::class, 'addScore']);
        Route::post('update_score/{id}', [PengawasController::class, 'updateScore']);
        Route::post('update_pengawas/{id}', [PengawasController::class, 'updatePengawas']);
        Route::post('update_username/{id}', [PengawasController::class, 'updateUsername']);
        Route::post('update_password/{id}', [PengawasController::class, 'updatePassword']);
    });

    Route::group(['middleware' => ['role:pengawas-khusus','status:aktif'], 'prefix' => 'pengawas-khusus', 'as' => 'pengawas-khusus.'], function () {
        Route::get('dashboard', [PengawasKhususController::class, 'index']);
        Route::get('show_score', [PengawasKhususController::class, 'showScore']);
        Route::get('chart_discovery', [PengawasKhususController::class, 'chartDiscovery']);
        
        Route::post('create_score', [PengawasKhususController::class, 'createScore']);
        Route::post('add_score', [PengawasKhususController::class, 'addScore']);        
        Route::post('/get_area', [PengawasKhususController::class, 'getArea']);

    });

    Route::group(['middleware' => ['role: vendor','status:aktif'], 'prefix' => 'vendor', 'as' => 'vendor.'], function() {
        Route::get('dashboard', [VendorController::class, 'index']);
        Route::get('chart_rating_2021', [VendorController::class,'getChartRating2021']);
        Route::get('chart_rating_2022', [VendorController::class,'getChartRating2022']);
        Route::get('show_criteria', [VendorController::class, 'showCriteria']);

        // Score
        Route::post('search_score', [VendorController::class, 'showScoreAll']);
        Route::get('show_score_all', [VendorController::class, 'showScoreAll']);
        Route::get('show_score_person/{id}', [VendorController::class, 'showScorePerson']);
        Route::get('show_score_month_22/{id}', [VendorController::class, 'showScoreMonth22']);
        Route::get('show_score_month_21/{id}', [VendorController::class, 'showScoreMonth21']);
        Route::get('show_score_person_21/{id}', [VendorController::class, 'showScorePerson21']);
        Route::get('detail_score/{id}', [VendorController::class, 'detailScore']);
        
    });

});

Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');
