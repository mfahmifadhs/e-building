<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ImportDataPegawai;
use App\Imports\ImportDataCriteria;
use App\Imports\ImportDataWorkingArea;
use App\Exports\ScoreExport;
use App\Models\User;
use App\Models\UserAccessModel;
use App\Models\WorkingAreaModel;
use App\Models\EmployeesModel;
use App\Models\CriteriaModel;
use App\Models\BuildingModel;
use App\Models\ScoreModel;
use App\Models\DetailScoreModel;
use Auth;
use Hash;
use Session;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $id = Auth::id();
        // 2021

        $rating21   = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','=','tbl_scores.emp_id')
                        ->select('id_employee','emp_category','tbl_employees.emp_name', DB::raw("Sum(total_score) as totalscore "))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->orderBy('totalscore','DESC')
                        ->groupBy('emp_name','id_employee','emp_category')
                        ->get();

        $totalkk21  = DB::table('tbl_scores')
                        ->select(DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->first();

        $totalkkm21 = DB::table('tbl_scores')
                        ->select(DB::raw("(DATE_FORMAT(score_dt, '%M')) as month"), DB::raw('sum(total_score) as totalscore21'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->orderBy(DB::raw("(DATE_FORMAT(score_dt, '%m'))", 'ASC'))
                        ->groupBy(DB::raw("(DATE_FORMAT(score_dt, '%M'))"))
                        ->get();

        $score21    = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','=','tbl_scores.emp_id')
                        ->join('tbl_users','tbl_users.id','=','tbl_scores.user_id')
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->orderBy('score_dt','DESC')
                        ->get();

        // 2022
        $month_now  = Carbon::now()->isoFormat('Y-MM');
        $month      = Carbon::now()->isoFormat('MMMM');
        $total      = DB::table('tbl_scores')->select(DB::raw('sum(total_score) as totalscore'))
                      ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')->first();
        $totalm     = DB::table('tbl_scores')
                      ->select(DB::raw("(DATE_FORMAT(score_dt, '%M')) as month"), DB::raw('sum(total_score) as totalscore'))
                      ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                      ->groupBy(DB::raw("(DATE_FORMAT(score_dt, '%M'))"))
                      ->get();

        $banquetmm      = DB::table('tbl_employees')->where('emp_category','bq')->orWhere('emp_category','mm')
                          ->where('status_id', 1)->count();
        $cleanservice   = DB::table('tbl_employees')->where('emp_category','cs')->where('status_id', 1)->count();
        $gardener       = DB::table('tbl_employees')->where('emp_category','gd')->where('status_id', 1)->count();
        $security       = DB::table('tbl_employees')->where('emp_category','sc')->where('status_id', 1)->count();
        $user_id        = DB::table('tbl_users')->select('id')->orderby('id', 'DESC')->first();

        $score_acc  = DB::table('tbl_scores')->select(DB::raw("Sum(total_score_accumulation) as totalscore "))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%m'))"), $month_now)->get();
        $check_acc  = DB::table('tbl_scores')->select("total_score_accumulation")->count();

        $rating     = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','=','tbl_scores.emp_id')
                        ->select('id_employee','emp_category','tbl_employees.emp_name', DB::raw("Sum(total_score) as totalscore ")) 
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->orderBy('totalscore','DESC')
                        ->groupBy('emp_name','id_employee','emp_category')
                        ->get();

        $pegawaiall = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','=','tbl_scores.emp_id')
                        ->select('id_employee','emp_name','score_dt','score_tm',
                         DB::raw("Sum(total_score_accumulation) as totalscore "))
                        ->orderBy('totalscore','DESC')
                        ->groupBy('emp_name','id_employee','score_dt','score_tm')
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%m'))"), $month_now)
                        ->get();

        $totalkk22cs  = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('emp_category', 'CS')
                        ->first();

        $totalkkm22cs = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw("(DATE_FORMAT(score_dt, '%M')) as month"), DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('emp_category', 'CS')
                        ->orderBy(DB::raw("(DATE_FORMAT(score_dt, '%m'))", 'ASC'))
                        ->groupBy(DB::raw("(DATE_FORMAT(score_dt, '%M'))"))
                        ->get();

        $score22cs = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->join('tbl_users','tbl_users.id','=','tbl_scores.user_id')
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('emp_category', 'CS')
                        ->orderBy('score_dt','DESC')
                        ->get();

        $totalkk22bm  = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('emp_category', 'BQ')
                        ->orWhere('emp_category', 'MM')
                        ->first();

        $totalkkm22bm = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw("(DATE_FORMAT(score_dt, '%M')) as month"), DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('emp_category', 'BQ')
                        ->orWhere('emp_category', 'MM')
                        ->orderBy(DB::raw("(DATE_FORMAT(score_dt, '%m'))", 'ASC'))
                        ->groupBy(DB::raw("(DATE_FORMAT(score_dt, '%M'))"))
                        ->get();
        $score22bm = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->join('tbl_users','tbl_users.id','=','tbl_scores.user_id')
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('emp_category', 'BQ')
                        ->orWhere('emp_category', 'MM')
                        ->orderBy('score_dt','DESC')
                        ->get();

        $totalkk22gd  = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('emp_category', 'GD')
                        ->first();

        $totalkkm22gd = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw("(DATE_FORMAT(score_dt, '%M')) as month"), DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('emp_category', 'GD')
                        ->orderBy(DB::raw("(DATE_FORMAT(score_dt, '%m'))", 'ASC'))
                        ->groupBy(DB::raw("(DATE_FORMAT(score_dt, '%M'))"))
                        ->get();
        $score22gd = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->join('tbl_users','tbl_users.id','=','tbl_scores.user_id')
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('emp_category', 'GD')
                        ->orderBy('score_dt','DESC')
                        ->get();

        $totalkk22sc  = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('emp_category', 'SC')
                        ->first();

        $totalkkm22sc = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw("(DATE_FORMAT(score_dt, '%M')) as month"), DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('emp_category', 'SC')
                        ->orderBy(DB::raw("(DATE_FORMAT(score_dt, '%m'))", 'ASC'))
                        ->groupBy(DB::raw("(DATE_FORMAT(score_dt, '%M'))"))
                        ->get();
        $score22sc = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->join('tbl_users','tbl_users.id','=','tbl_scores.user_id')
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('emp_category', 'SC')
                        ->orderBy('score_dt','DESC')
                        ->get();
        

        return view('v_admin.index', compact('banquetmm','cleanservice','gardener','security','pegawaiall','month','score_acc','check_acc',
                                             'rating','score22cs','totalkk22cs','totalkkm22cs','score22bm','totalkk22bm','totalkkm22bm',
                                             'score22gd','totalkk22gd','totalkkm22gd','score22sc','totalkk22sc','totalkkm22sc','totalm',
                                             'total','rating21','totalkk21','totalkkm21',
                                             'score21'));
        return redirect("login")->with('failed', 'You are not allowed to access');
    }

    // ==================================
    // PROFILE
    // ==================================

    public function showProfile($id)
    {
        $access     = DB::table('tbl_users_access')
                        ->join('tbl_users', 'tbl_users.id', 'tbl_users_access.user_id')
                        ->where('user_id', $id)
                        ->get();

        $admin   = DB::table('tbl_users')
                        ->join('tbl_status', 'tbl_status.id_status', 'tbl_users.status_id')
                        ->where('id', $id)
                        ->get();

        return view('v_admin.show_profile', compact('admin','access'));
    }

    public function changePassword(Request $request)
    {
        $id = $request->id;

        if ($id != 1) {

            $newpass    = User::where('id', $id)
                                ->update([
                                    'password' => Hash::make($request->new_password)
                                ]);
            if ($id != 2 && $id != 3 && $id != 4) {
                return redirect('admin-master/edit_pengawas/'. $id)->with('success','Berhasil mengubah password');
            }else{
                return redirect('admin-master/show_profile/'. $id)->with('success','Berhasil mengubah password');
            }

        }else{

            $hashedPassword = Auth::user()->password;

            if(\Hash::check($request->old_password, $hashedPassword)){
                $newpass    = User::where('id', $id)
                                ->update([
                                    'password' => Hash::make($request->new_password)
                                ]);

                    return redirect('signout')->with('success','Berhasil mengubah password');
            }else{
                return redirect('admin-master/show_profile/'. $id)->with('failed', 'Password Lama Anda Salah');
            }
        }

    }

    public function changeProfile(Request $request)
    {
        $id = $request->id;
        $cekuser = DB::table('tbl_users')->where('username', $request->username)->count();


        if($cekuser == 1)
        {
            return redirect('admin-master/show_profile/'. $ID)->with('failed', 'Username Telah Terdaftar');
        }elseif($request->username == null)
        {
            $user   = User::where('id', $id)
                            ->update([
                                'name'      => $request->name,
                                'username'  => Auth::user()->username,
                                'status_id' => $request->status_id
                            ]);

            return redirect('admin-master/show_profile/'. $id)->with('success','Berhasil Mengubah Data Pengguna');
        }else{
            $user   = User::where('id', $id)
                            ->update([
                                'name'      => $request->name,
                                'username'  => $request->username,
                                'status_id' => $request->status_id
                            ]);

            return redirect('admin-master/show_profile/'. $id)->with('success','Berhasil Mengubah Data Pengguna');
        }

    }

    public function createUser()
    {
        $role   = DB::table('tbl_roles')->get();
        $status = DB::table('tbl_status')->orderBy('id_status','DESC')->get();
        return view('v_admin.create_user', compact('role','status'));
    }

    public function showEmployee($id)
    {
        if ($id == 2) {
            return redirect('admin-master/show_cleaning_service');
        }elseif($id == 4) {
            return redirect('admin-master/show_security');
        }else{
            $banquetmm    = DB::table('tbl_employees')
                                ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                                ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                                ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                                ->where('tbl_employees.emp_category', 'BQ')
                                ->orWhere('tbl_employees.emp_category', 'MM')
                                ->orWhere('tbl_employees.emp_category', 'GD')
                                ->get();

            return view('v_admin.show_banquet_multimedia', compact('banquetmm'));
        }
    }

    // ================
    // Bar Chart 
    // ================

    public function getChartRating2022()
    {
        $month_now  = date('m', strtotime(now()));
        $result     = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','=','tbl_scores.emp_id')
                        ->select(DB::raw("(DATE_FORMAT(score_dt, '%M')) as month"), DB::raw("Sum(total_score) as totalscore "))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->orderBy('score_dt','ASC')
                        ->groupBy(DB::raw("(DATE_FORMAT(score_dt, '%M'))"))->limit(5)
                        ->get();      

        return response()->json($result);
    }

    public function getChartRating2021()
    {
        $result     = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','=','tbl_scores.emp_id')
                        ->select(DB::raw("(DATE_FORMAT(score_dt, '%M')) as month"), DB::raw("Sum(total_score) as totalscore "))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->orderBy('score_dt','ASC')
                        ->groupBy(DB::raw("(DATE_FORMAT(score_dt, '%M'))"))->limit(5)
                        ->get();      

        return response()->json($result);
    }

    // ================
    // Working Area
    // ================

    public function showWorkingArea()
    {
        $banquetmm    = DB::table('tbl_working_areas')->where('working_area_category','bm')->orderby('id_working_area','ASC')->get();
        $cleanservice = DB::table('tbl_working_areas')->where('working_area_category','cs')->orderby('id_working_area','ASC')->get();
        $gardener     = DB::table('tbl_working_areas')->where('working_area_category','gd')->orderby('id_working_area','ASC')->get();
        $security     = DB::table('tbl_working_areas')->where('working_area_category','sc')->orderby('id_working_area','ASC')->get();
        return view('v_admin.show_working_area', compact('banquetmm','cleanservice','gardener','security'));
    }

    public function uploadWorkingArea(Request $request)
    {
        Excel::import(new ImportDataWorkingArea, $request->file('upload-working-area'));
        return redirect('admin-master/show_working_area')->with('success','Berhasil Upload Data Area Kerja');
    }

    public function addWorkingArea(Request $request)
    {
        $workarea = new WorkingAreaModel();
        $workarea->working_area_category = $request->input('working_area_category');
        $workarea->working_area_name     = $request->input('working_area_name');
        $workarea->save();

        return redirect('admin-master/show_working_area')->with('success','Berhasil Menambah Data Area Kerja');
    }

    public function updateWorkingArea(Request $request, $id)
    {
        $workarea = WorkingAreaModel::where('id_working_area', $id)
                        ->update([
                            'working_area_name'        => $request->working_area_name,
                            'working_area_category'    => $request->working_area_category
                        ]);

        return redirect('admin-master/show_working_area')->with('success','Berhasil Mengubah Area Kerja');
    }

    public function deleteWorkingArea(Request $request, $id)
    {
        $cekworkarea = DB::table('tbl_scores')
                        ->join('tbl_working_areas','tbl_working_areas.id_working_area','tbl_scores.working_area_id')
                        ->count();
        if($cekworkarea == 1)
        {
            return redirect('admin-master/show_working_area')->with('failed', 'Error !, Data Gagal di Hapus');
        }else{
            $workarea = WorkingAreaModel::where('id_working_area', $id);
            $workarea->delete();

            return redirect('admin-master/show_working_area')->with('success', 'Berhasil Menghapus Data Area Kerja');
        }
    }   

    

    // ==================================
    // PENGAWAS
    // ==================================

    public function showPengawas()
    {
        $pengawas = DB::table('tbl_users_access')
                    ->rightjoin('tbl_users','tbl_users.id','tbl_users_access.user_id')
                    ->join('tbl_roles', 'tbl_roles.id_role', 'tbl_users.role_id')
                    ->join('tbl_status', 'tbl_status.id_status', 'tbl_users.status_id')
                    ->where('role_id', '=' , 3)
                    ->orWhere('role_id', '=' , 4)
                    ->get();
        return view('v_admin.show_pengawas', compact('pengawas'));
    }

    public function editPengawas($id)
    {
        
        $pengawas   = DB::table('tbl_users_access')
                        ->rightjoin('tbl_users','tbl_users.id','tbl_users_access.user_id')
                        ->join('tbl_roles','tbl_roles.id_role','tbl_users.role_id')
                        ->join('tbl_status','tbl_status.id_status','tbl_users.status_id')
                        ->where('id', $id)
                        ->get();

        return view('v_admin.edit_pengawas', compact('pengawas'));
    }

    public function updatePengawas(Request $request, $id)
    {
        $userpengawas   = DB::table('tbl_users')->select('username')->where('id', $id)->first();
        $cekuser        = DB::table('tbl_users')->where('username', $request->username)->count();
        $cekacess       = DB::table('tbl_users_access')->where('user_id',$id)->count();
        $accessid       = DB::table('tbl_users_access')->count();
        
        if($cekuser == 1){

            return redirect('admin-master/edit_pengawas/'. $id)->with('failed', 'Username Telah Terdaftar');

        }elseif($request->username == null){
            $pengawas   = User::where('id', $id)
                            ->update([
                                'name'      => $request->name,
                                'username'  => $userpengawas->username,
                                'status_id' => $request->status_id
                            ]);

        }else{
            $pengawas   = User::where('id', $id)
                            ->update([
                                'name'      => $request->name,
                                'username'  => $request->username,
                                'status_id' => $request->status_id
                            ]);
        }

        if($cekacess == 1){
            $user_access = UserAccessModel::where('user_id', $id)
                            ->update([                 
                                'user_id'               => $id,
                                'is_banquet_multimedia' => $request->is_banquet_multimedia,
                                'is_cleaning_service'   => $request->is_cleaning_service,
                                'is_gardener'           => $request->is_gardener,
                                'is_security'           => $request->is_security,
                                'is_pet_control'        => $request->is_pet_control
                            ]);
        }else{
            $user_access                        = new UserAccessModel();
            $user_access->id_user_access        = $accessid+1;
            $user_access->user_id               = $id;
            $user_access->is_banquet_multimedia = $request->input('is_banquet_multimedia');
            $user_access->is_cleaning_service   = $request->input('is_cleaning_service');
            $user_access->is_gardener           = $request->input('is_gardener');
            $user_access->is_security           = $request->input('is_security');
            $user_access->is_pet_control        = $request->input('is_pet_control');
            $user_access->save();
        }

        

        return redirect('admin-master/show_pengawas')->with('success', 'Berhasil Mengubah Data Pengawas');
    }

    public function DetailScorePengawas($id)
    {
        $score      = DB::table('scores')
                      ->select('cleaningservices.id as nip','scores.id as id_score', 'cleaningservices.*', 
                        'users.*', 'roles.*', 'status.*', 'scores.*','floors.*','buildings.*')
                      ->join('cleaningservices', 'cleaningservices.id', '=', 'scores.cleaningservices_id')
                      ->join('users', 'users.id', '=', 'cleaningservices.user_id')
                      ->join('roles', 'roles.id', '=', 'users.role_id')
                      ->join('status', 'status.id', '=', 'cleaningservices.status_id')
                      ->join('floors', 'floors.id', '=', 'scores.floor_id')
                      ->join('buildings', 'buildings.id', '=', 'floors.building_id')
                      ->where('scores.user_id','=', $id)
                      ->get();
        $pengawas   = DB::table('users')->where('id',$id)->get();
        return view('admin.detail_scorepengawas',compact('score','pengawas'));
    }  

    public function updateUsernamePengawas(Request $request, $id)
    {
        $check_user = DB::table('users')->select('username')->where('username','=', $request->get('username'))->count();
        $pengawas = User::find($id);

        if($check_user == 1){
            $pengawas->role_id      = $request->get('role_id');
            $pengawas->name         = $request->get('name');
            $pengawas->email        = $request->get('email');
            $pengawas->password     = $request->get('password');
            $pengawas->status_id    = $request->get('status_id');
            $pengawas->save();
            return redirect('admin-master/show_pengawas')->with('delete', 'Username sudah terdaftar!');
        }else{
            $pengawas->role_id      = $request->get('role_id');
            $pengawas->name         = $request->get('name');
            $pengawas->email        = $request->get('email');
            $pengawas->username     = $request->get('username');
            $pengawas->password     = $request->get('password');
            $pengawas->status_id    = $request->get('status_id');
            $pengawas->save();
            return redirect('admin-master/show_pengawas')->with('success', 'Berhasil Mengubah Username!');
        }
    }     

    public function updatePassword(Request $request, $id)
    {
        $pengawas = User::find($id);
        $pengawas->role_id      = $request->get('role_id');
        $pengawas->name         = $request->get('name');
        $pengawas->email        = $request->get('email');
        $pengawas->username     = $request->get('username');
        $pengawas->password     = Hash::make($request->get('password'));
        $pengawas->status_id    = $request->get('status_id');
        $pengawas->save();

        return redirect('admin-master/show_pengawas')->with('success', 'Berhasil Mengubah Password!');
    }

    public function deletePengawas(Request $request, $id)
    {
        $cekpengawas = DB::table('tbl_scores')
                        ->join('tbl_users','tbl_users.id','tbl_scores.user_id')
                        ->where('user_id', $id)
                        ->count();

        if($cekpengawas == 1)
        {
            return redirect('admin-master/show_pengawas')->with('failed', 'Error !, Data Gagal di Hapus');
        }else{
            $pengawas = User::where('id', $id);
            $pengawas->delete();

            return redirect('admin-master/show_pengawas')->with('success', 'Berhasil Menghapus Data Pengawas');
        }
    }     

    public function restorePengawas(Request $request, $id)
    {
        $pengawas = User::find($id);
        $pengawas->save();

        return redirect('admin-master/show_pengawas_deleted')->with('success', 'Berhasil Memulihkan Data!');
    }   

    // ==================================
    // VENDOR
    // ==================================

    public function showVendor()
    {
        $vendor = DB::table('tbl_employees')
                    ->select('id','name','username','status_name', DB::raw('count(user_id) as totalpegawai'))
                    ->join('tbl_users', 'tbl_users.id','tbl_employees.user_id')
                    ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                    ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_users.status_id')
                    ->where('role_id', '=' , 2)
                    ->groupBy('id','name','username','status_name')
                    ->get();
        return view('v_admin.show_vendor', compact('vendor'));
    }

    public function editVendor($id)
    {
        
        $vendor     = DB::table('tbl_users')
                        ->join('tbl_roles','tbl_roles.id_role','tbl_users.role_id')
                        ->join('tbl_status','tbl_status.id_status','tbl_users.status_id')
                        ->where('id', $id)
                        ->get();

        return view('v_admin.edit_vendor', compact('vendor'));
    }

    public function updateVendor(Request $request, $id)
    {
        $vendor = User::find($id);
        $vendor->role_id      = $request->get('role_id');
        $vendor->name         = $request->get('name');
        $vendor->username     = $request->get('username');
        $vendor->status_id    = $request->get('status_id');
        $vendor->save();

        return redirect('admin-master/show_vendor')->with('success', 'Berhasil Mengubah Data Vendor!');
    }    

    public function updateUsernameVendor(Request $request, $id)
    {
        $check_user = DB::table('users')->select('username')->where('username','=', $request->get('username'))->count();
        $vendor = User::find($id);

        if($check_user == 1){
            $vendor->role_id      = $request->get('role_id');
            $vendor->name         = $request->get('name');
            $vendor->email        = $request->get('email');
            $vendor->password     = $request->get('password');
            $vendor->status_id    = $request->get('status_id');
            $vendor->save();
            return redirect('admin-master/show_vendor')->with('delete', 'Username sudah terdaftar');
        }else{
            $vendor->role_id      = $request->get('role_id');
            $vendor->name         = $request->get('name');
            $vendor->email        = $request->get('email');
            $vendor->username     = $request->get('username');
            $vendor->password     = $request->get('password');
            $vendor->status_id    = $request->get('status_id');
            $vendor->save();
            return redirect('admin-master/show_vendor')->with('success', 'Berhasil Mengubah Username!');
        }
    }    

    public function updatePasswordVendor(Request $request, $id)
    {
        $vendor = User::find($id);
        $vendor->role_id      = $request->get('role_id');
        $vendor->name         = $request->get('name');
        $vendor->email        = $request->get('email');
        $vendor->username     = $request->get('username');
        $vendor->password     = Hash::make($request->get('password'));
        $vendor->status_id    = $request->get('status_id');
        $vendor->save();

        return redirect('admin-master/show_vendor')->with('success', 'Berhasil Mengubah Password!');
    }

    public function deleteVendor(Request $request, $id)
    {
        $vendor = User::find($id);
        $vendor->delete();

        return redirect('admin-master/show_vendor')->with('success', 'Berhasil Menghapus Data!');
    }   


    // ==================================
    // BANQUET DAN MULTIMEDIA
    // ==================================

    public function showBanquetMM()
    {
        $id = Auth::id();
        $banquetmm    = DB::table('tbl_employees')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->where('tbl_employees.emp_category', 'BQ')
                            ->orWhere('tbl_employees.emp_category', 'MM')
                            ->get();

        return view('v_admin.show_banquet_multimedia', compact('banquetmm'));
    }

    public function editBanquetMM($id)
    {
        $banquetmm   = DB::table('tbl_employees')
                            ->join('tbl_users','tbl_users.id','=','tbl_employees.user_id')
                            ->join('tbl_status','tbl_status.id_status','=','tbl_employees.status_id')
                            ->where('id_employee', $id)
                            ->get();
        return view('v_admin.edit_banquet_mm', compact('banquetmm'));
    }

    public function uploadBanquetMM(Request $request)
    {
        Excel::import(new ImportDataPegawai, $request->file('upload-pegawai'));
        return redirect('admin-master/show_banquet_mm')->with('success','Berhasil Upload Data Banquet / Multimedia');
    }

    public function addBanquetMM(Request $request)
    {
        $banquetmm                   = new EmployeesModel();
        $banquetmm->id_employee      = $request->input('id_employee');
        $banquetmm->user_id          = $request->input('user_id');
        $banquetmm->emp_category     = $request->input('emp_category');
        $banquetmm->emp_name         = $request->input('emp_name');
        $banquetmm->emp_position     = $request->input('emp_position');
        $banquetmm->emp_phone_number = $request->input('emp_phone_number');
        $banquetmm->emp_gender       = $request->input('emp_gender');
        $banquetmm->emp_religion     = $request->input('emp_religion');
        $banquetmm->emp_address      = $request->input('emp_address');
        $banquetmm->status_id        = $request->input('status_id');
        $banquetmm->save();
        return redirect('admin-master/show_banquet_mm')->with('success', 'Berhasil Menambah Data Banquet / Multimedia!');
    }

    public function updateBanquetMM(Request $request, $id)
    {
        $banquetmm = EmployeesModel::where('id_employee', $id)
                        ->update([
                            'user_id'           => $request->user_id,
                            'emp_category'      => $request->emp_category,
                            'emp_name'          => $request->emp_name,
                            'emp_position'      => $request->emp_position,
                            'emp_phone_number'  => $request->emp_phone_number,
                            'emp_gender'        => $request->emp_gender,
                            'emp_religion'      => $request->emp_religion,
                            'emp_address'       => $request->emp_address,
                            'status_id'         => $request->status_id
                        ]);

        return redirect('admin-master/show_banquet_mm')->with('success', 'Berhasil Mengubah Data Banquet / Multimedia!');
    }  

    public function deleteBanquetMM(Request $request, $id)
    {
        $banquetmm = EmployeesModel::where('id_employee', $id);
        $banquetmm->delete();

        return redirect('admin-master/show_banquet_mm')->with('success', 'Berhasil Menghapus Data Banquet / Multimedia!');
    } 

    public function deleteAllBanquetMM()
    {
        $banquet = EmployeesModel::where('emp_category', 'bq');
        $banquet->delete();
        $mm = EmployeesModel::where('emp_category', 'mm');
        $mm->delete();

        return redirect('admin-master/show_banquet_mm')->with('success', 'Berhasil Menghapus Semua Data Banquet & MM!');
    } 

    // ==================================
    // CLEANING SERVICES
    // ==================================

    public function showCleaningService()
    {
        $id = Auth::id();
        $cleanservice    = DB::table('tbl_employees')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->where('tbl_employees.emp_category', 'cs')
                            ->get();

        return view('v_admin.show_cleaning_service', compact('cleanservice'));
    }

    public function uploadCleaningService(Request $request)
    {
        Excel::import(new ImportDataPegawai, $request->file('upload-pegawai'));
        return redirect('admin-master/show_cleaning_service')->with('success','Berhasil Upload Data Cleaning Service');
    }

    public function addCleaningService(Request $request)
    {
        $add_cleanservice                   = new EmployeesModel();
        $add_cleanservice->id_employee      = $request->input('id_employee');
        $add_cleanservice->user_id          = $request->input('user_id');
        $add_cleanservice->emp_category     = $request->input('emp_category');
        $add_cleanservice->emp_name         = $request->input('emp_name');
        $add_cleanservice->emp_position     = $request->input('emp_position');
        $add_cleanservice->emp_phone_number = $request->input('emp_phone_number');
        $add_cleanservice->emp_gender       = $request->input('emp_gender');
        $add_cleanservice->emp_religion     = $request->input('emp_religion');
        $add_cleanservice->emp_address      = $request->input('emp_address');
        $add_cleanservice->status_id        = $request->input('status_id');
        $add_cleanservice->save();
        return redirect('admin-master/show_cleaning_service')->with('success', 'Berhasil Menambah Data Cleaning Service!');
    }

    public function editCleaningService($id)
    {
        $cleanservice   = DB::table('tbl_employees')
                            ->join('tbl_users','tbl_users.id','=','tbl_employees.user_id')
                            ->join('tbl_status','tbl_status.id_status','=','tbl_employees.status_id')
                            ->where('id_employee', $id)
                            ->get();
        return view('v_admin.edit_cleaning_service', compact('cleanservice'));
    }

    public function updateCleaningService(Request $request, $id)
    {
        $cleanservice = EmployeesModel::where('id_employee', $id)
                        ->update([
                            'user_id'           => $request->user_id,
                            'emp_category'      => $request->emp_category,
                            'emp_name'          => $request->emp_name,
                            'emp_position'      => $request->emp_position,
                            'emp_phone_number'  => $request->emp_phone_number,
                            'emp_gender'        => $request->emp_gender,
                            'emp_religion'      => $request->emp_religion,
                            'emp_address'       => $request->emp_address,
                            'status_id'         => $request->status_id
                        ]);

        return redirect('admin-master/show_cleaning_service')->with('success', 'Berhasil Mengubah Data Cleaning Service!');
    }  

    public function deleteCleaningService(Request $request, $id)
    {
        $cekuser      = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->where('emp_id', $id)
                        ->count();
                        
        if ($cekuser == 0) {
            $cleanservice = EmployeesModel::where('id_employee', $id);
            $cleanservice->delete();

            return redirect('admin-master/show_cleaning_service')->with('success', 'Berhasil Menghapus Data Cleaning Service!');
        }else{
            return redirect('admin-master/show_cleaning_service')->with('failed', 'Error, Data Gagal Di Hapus');
        }
        
    }  

    public function deleteAllCleaningService()
    {
        $cleanservice = EmployeesModel::where('emp_category', 'cs');
        $cleanservice->delete();

        return redirect('admin-master/show_cleaning_service')->with('success', 'Berhasil Menghapus Semua Data Cleaning Service!');
    } 

    // ==================================
    // GARDENERS
    // ==================================

    public function showGardener()
    {
        $id = Auth::id();
        $gardener    = DB::table('tbl_employees')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->where('tbl_employees.emp_category', 'GD')
                            ->get();

        return view('v_admin.show_gardener', compact('gardener'));
    }

    public function editGardener($id)
    {
        $gardener   = DB::table('tbl_employees')
                            ->join('tbl_users','tbl_users.id','=','tbl_employees.user_id')
                            ->join('tbl_status','tbl_status.id_status','=','tbl_employees.status_id')
                            ->where('id_employee', $id)
                            ->get();
        return view('v_admin.edit_gardener', compact('gardener'));
    }

    public function uploadGardener(Request $request)
    {
        Excel::import(new ImportDataPegawai, $request->file('upload-pegawai'));
        return redirect('admin-master/show_gardener')->with('success','Berhasil Upload Data Banquet / Multimedia');
    }

    public function addGardener(Request $request)
    {
        $gardener                   = new EmployeesModel();
        $gardener->id_employee      = $request->input('id_employee');
        $gardener->user_id          = $request->input('user_id');
        $gardener->emp_category     = strtoupper($request->input('emp_category'));
        $gardener->emp_name         = strtoupper($request->input('emp_name'));
        $gardener->emp_position     = strtoupper($request->input('emp_position'));
        $gardener->emp_phone_number = $request->input('emp_phone_number');
        $gardener->emp_gender       = strtoupper($request->input('emp_gender'));
        $gardener->emp_religion     = strtoupper($request->input('emp_religion'));
        $gardener->emp_address      = strtoupper($request->input('emp_address'));
        $gardener->status_id        = $request->input('status_id');
        $gardener->save();
        return redirect('admin-master/show_gardener')->with('success', 'Berhasil Menambah Data Banquet / Multimedia!');
    }

    public function updateGardener(Request $request, $id)
    {
        $gardener = EmployeesModel::where('id_employee', $id)
                        ->update([
                            'user_id'           => $request->user_id,
                            'emp_category'      => $request->emp_category,
                            'emp_name'          => $request->emp_name,
                            'emp_position'      => $request->emp_position,
                            'emp_phone_number'  => $request->emp_phone_number,
                            'emp_gender'        => $request->emp_gender,
                            'emp_religion'      => $request->emp_religion,
                            'emp_address'       => $request->emp_address,
                            'status_id'         => $request->status_id
                        ]);

        return redirect('admin-master/show_gardener')->with('success', 'Berhasil Mengubah Data Banquet / Multimedia!');
    }  

    public function deleteGardener(Request $request, $id)
    {
        $gardener = EmployeesModel::where('id_employee', $id);
        $gardener->delete();

        return redirect('admin-master/show_gardener')->with('success', 'Berhasil Menghapus Data Banquet / Multimedia!');
    } 

    public function deleteAllGardener()
    {
        $gardener = EmployeesModel::where('emp_category', 'Pegawai Taman');
        $gardener->delete();

        return redirect('admin-master/show_gardener')->with('success', 'Berhasil Menghapus Semua Data Pegawai Taman!');
    } 

    // ==================================
    // SECURITY
    // ==================================

    public function showSecurity()
    {
        $id = Auth::id();
        $security    = DB::table('tbl_employees')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->where('tbl_employees.emp_category', 'SC')
                            ->get();

        return view('v_admin.show_security', compact('security'));
    }

    public function editSecurity($id)
    {
        $security   = DB::table('tbl_employees')
                            ->join('tbl_users','tbl_users.id','=','tbl_employees.user_id')
                            ->join('tbl_status','tbl_status.id_status','=','tbl_employees.status_id')
                            ->where('id_employee', $id)
                            ->get();
        return view('v_admin.edit_security', compact('security'));
    }

    public function uploadSecurity(Request $request)
    {
        Excel::import(new ImportDataPegawai, $request->file('upload-pegawai'));
        return redirect('admin-master/show_security')->with('success','Berhasil Upload Data Security' );  
    }

    public function addSecurity(Request $request)
    {
        $add_security                   = new EmployeesModel();
        $add_security->id_employee      = $request->input('id_employee');
        $add_security->user_id          = $request->input('user_id');
        $add_security->emp_category     = strtoupper($request->input('emp_category'));
        $add_security->emp_name         = strtoupper($request->input('emp_name'));
        $add_security->emp_position     = strtoupper($request->input('emp_position'));
        $add_security->emp_phone_number = $request->input('emp_phone_number');
        $add_security->emp_gender       = strtoupper($request->input('emp_gender'));
        $add_security->emp_religion     = strtoupper($request->input('emp_religion'));
        $add_security->emp_address      = strtoupper($request->input('emp_address'));
        $add_security->status_id        = $request->input('status_id');
        $add_security->save();
        return redirect('admin-master/show_security')->with('success', 'Berhasil Menambah Data Security');
    }

    public function updateSecurity(Request $request, $id)
    {
        $security = EmployeesModel::where('id_employee', $id)
                        ->update([
                            'user_id'           => $request->user_id,
                            'emp_category'      => $request->emp_category,
                            'emp_name'          => $request->emp_name,
                            'emp_position'      => $request->emp_position,
                            'emp_phone_number'  => $request->emp_phone_number,
                            'emp_gender'        => $request->emp_gender,
                            'emp_religion'      => $request->emp_religion,
                            'emp_address'       => $request->emp_address,
                            'status_id'         => $request->status_id
                        ]);

        return redirect('admin-master/show_security')->with('success', 'Berhasil Mengubah Security!');
    }  

    public function deleteSecurity(Request $request, $id)
    {
        $security = EmployeesModel::where('id_employee', $id);
        $security->delete();

        return redirect('admin-master/show_security')->with('success', 'Berhasil Menghapus Security!');
    } 

    public function deleteAllSecurity()
    {
        $security = EmployeesModel::where('emp_category', 'Security');
        $security->delete();

        return redirect('admin-master/show_security')->with('success', 'Berhasil Menghapus Semua Data Security!');
    } 


    // ================
    // PAGE SCORE
    // ================

    public function showScoreAll(Request $request)
    {
        $id = Auth::id();
        $today = date('Y-m-d', strtotime(now()));
        $month = date('m', strtotime(now()));

        if($request->start_dt != null && $request->end_dt != null && $request->emp_category == null){
            $score  = DB::table('tbl_score_details')
                        ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                        ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                        ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                        ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                        ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                        ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                        ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                        ->whereBetween('score_dt', [$request->start_dt, $request->end_dt])
                        ->orderBy('tbl_scores.score_dt','DESC')
                        ->orderBy('tbl_scores.score_tm','DESC')
                        ->where('score',1)
                        ->get();
        }elseif($request->start_dt == null && $request->end_dt == null && $request->emp_category != null){
            if($request->emp_category == 'bm')
            {
                $score  = DB::table('tbl_score_details')
                            ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                            ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where('emp_category', 'bq')
                            ->orWhere('emp_category', 'mm')
                            ->orderBy('tbl_scores.score_dt','DESC')
                            ->orderBy('tbl_scores.score_tm','DESC')
                            ->where('score',1)
                            ->get();
            }else{
                $score  = DB::table('tbl_score_details')
                            ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                            ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where('emp_category', $request->emp_category)
                            ->orderBy('tbl_scores.score_dt','DESC')
                            ->orderBy('tbl_scores.score_tm','DESC')
                            ->where('score',1)
                            ->get(); 
            }

        }elseif($request->start_dt != null && $request->end_dt != null && $request->emp_category != null){
            if($request->emp_category == 'bm'){

                $score  = DB::table('tbl_score_details')
                            ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                            ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where('emp_category', 'bq')
                            ->orWhere('emp_category', 'mm')
                            ->whereBetween('score_dt', [$request->start_dt, $request->end_dt])
                            ->orderBy('tbl_scores.score_dt','DESC')
                            ->orderBy('tbl_scores.score_tm','DESC')
                            ->where('score',1)
                            ->get();

            }else{

                $score  = DB::table('tbl_score_details')
                            ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                            ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where('emp_category', $request->emp_category)
                            ->whereBetween('score_dt', [$request->start_dt, $request->end_dt])
                            ->orderBy('tbl_scores.score_dt','DESC')
                            ->orderBy('tbl_scores.score_tm','DESC')
                            ->where('score',1)
                            ->get(); 
            }
        }else{
            $score  = DB::table('tbl_score_details')
                        ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                        ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                        ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                        ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                        ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                        ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                        ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                        ->orderBy('tbl_scores.score_dt','DESC')
                        ->orderBy('tbl_scores.score_tm','DESC')
                        ->where('score',1)
                        ->get();
        }

        return view('v_admin.show_score_all', compact('score'));
    }

    public function showScorePerson($id)
    {
        $score      = DB::table('tbl_scores')
                        ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                        ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                        ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                        ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                        ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                        ->orderBy('tbl_scores.score_dt','DESC')
                        ->orderBy('tbl_scores.score_tm','DESC')
                        ->where('tbl_scores.emp_id', $id)
                        ->get();

        $pegawai    = DB::table('tbl_scores')
                      ->join('tbl_employees', 'tbl_employees.id_employee', 'tbl_scores.emp_id')
                      ->select('emp_name', DB::raw('sum(total_score) as totalscore'))
                      ->where('tbl_employees.id_employee',$id)
                      ->groupBy('emp_name')->get();
        return view('v_admin.show_score_person', compact('score','pegawai'));
    }

    public function showScorePerson21($id)
    {
        $score      = DB::table('tbl_scores')
                        ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                        ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                        ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                        ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                        ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->where('tbl_scores.emp_id', $id)
                        ->get();

        $pegawai    = DB::table('tbl_scores')
                      ->join('tbl_employees', 'tbl_employees.id_employee', 'tbl_scores.emp_id')
                      ->select('emp_name', DB::raw('sum(total_score) as totalscore'))
                      ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                      ->where('tbl_employees.id_employee',$id)
                      ->groupBy('emp_name')->get();
        return view('v_admin.show_score_person', compact('score','pegawai'));
    }

    public function showScoreMonth22($category, $id)
    {
        if($id == 2022){

            if ($category == 'cs') {
                $score      = DB::table('tbl_score_details')
                            ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                            ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                            ->where('score',1)
                            ->where('emp_category', 'CS')
                            ->orderBy('score_dt','DESC')
                            ->get();
            }elseif ($category == 'bm') {
                $score      = DB::table('tbl_score_details')
                            ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                            ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                            ->where('score',1)
                            ->where('emp_category', 'BQ')
                            ->orWhere('emp_category', 'MM')
                            ->orderBy('score_dt','DESC')
                            ->get();
            }elseif ($category == 'gd') {
                $score      = DB::table('tbl_score_details')
                            ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                            ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                            ->where('score',1)
                            ->where('emp_category', 'GD')
                            ->orderBy('score_dt','DESC')
                            ->get();
            }elseif ($category == 'sc') {
                $score      = DB::table('tbl_score_details')
                            ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                            ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                            ->where('score',1)
                            ->where('emp_category', 'SC')
                            ->orderBy('score_dt','DESC')
                            ->get();
            }
            
        }else{
            if($category == 'cs') {
                $score      = DB::table('tbl_score_details')
                                ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                                ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                                ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                                ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                                ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                                ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                                ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                                ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                                ->where(DB::raw("(DATE_FORMAT(score_dt, '%M'))"), $id)
                                ->where('score',1)
                                ->where('emp_category', 'CS')
                                ->orderBy('score_dt','DESC')
                                ->get();
            }elseif($category == 'bm') {
                $score      = DB::table('tbl_score_details')
                                ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                                ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                                ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                                ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                                ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                                ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                                ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                                ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                                ->where(DB::raw("(DATE_FORMAT(score_dt, '%M'))"), $id)
                                ->where('score',1)
                                ->where('emp_category', 'BQ')
                                ->orWhere('emp_category', 'MM')
                                ->orderBy('score_dt','DESC')
                                ->get();
            }elseif($category == 'gd') {
                $score      = DB::table('tbl_score_details')
                                ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                                ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                                ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                                ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                                ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                                ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                                ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                                ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                                ->where(DB::raw("(DATE_FORMAT(score_dt, '%M'))"), $id)
                                ->where('score',1)
                                ->where('emp_category', 'GD')
                                ->orderBy('score_dt','DESC')
                                ->get();
            }elseif($category == 'sc') {
                $score      = DB::table('tbl_score_details')
                                ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                                ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                                ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                                ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                                ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                                ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                                ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                                ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                                ->where(DB::raw("(DATE_FORMAT(score_dt, '%M'))"), $id)
                                ->where('score',1)
                                ->where('emp_category', 'SC')
                                ->orderBy('score_dt','DESC')
                                ->get();
            }
        }
        
        return view('v_admin.show_score_all', compact('score'));
    }

    public function showScoreMonth21($id)
    {
        if ($id == 2021) {
            $score      = DB::table('tbl_score_details')
                            ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                            ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                            ->orderBy('score_dt','DESC')
                            ->where('score',1)
                            ->get();

            $pegawai    = DB::table('tbl_scores')
                      ->join('tbl_employees', 'tbl_employees.id_employee', 'tbl_scores.emp_id')
                      ->select('emp_name', DB::raw('sum(total_score) as totalscore'))
                      ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                      ->orderBy('score_dt','DESC')
                      ->groupBy('emp_name')->get();
        }else{
            $score      = DB::table('tbl_score_details')
                            ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                            ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%M'))"), $id)
                            ->orderBy('score_dt','DESC')
                            ->where('score',1)
                            ->get();

            $pegawai    = DB::table('tbl_scores')
                          ->join('tbl_employees', 'tbl_employees.id_employee', 'tbl_scores.emp_id')
                          ->select('emp_name', DB::raw('sum(total_score) as totalscore'))
                          ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                          ->where(DB::raw("(DATE_FORMAT(score_dt, '%M'))"), $id)
                          ->orderBy('score_dt','DESC')
                          ->groupBy('emp_name')->get();
        }

        return view('v_admin.show_score_all', compact('score','pegawai'));
    }

    public function detailScore($id)
    {
        $ctg       = DB::table('tbl_scores')->select('emp_category')
                    ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                    ->first();

        $score     = DB::table('tbl_scores')
                    ->join('tbl_employees','tbl_employees.id_employee','=','tbl_scores.emp_id')
                    ->join('tbl_working_areas','tbl_working_areas.id_working_area','=','tbl_scores.working_area_id')
                    ->where('tbl_scores.id_score','=',$id)
                    ->get();
        $workarea  = DB::table('tbl_working_areas')
                    ->where('working_area_category', $ctg->emp_category)
                    ->get();
        $detail_sp = DB::table('tbl_score_details')
                     ->join('tbl_criterias','tbl_criterias.id_criteria','=','tbl_score_details.criteria_id')
                     ->join('tbl_scores','tbl_scores.id_score','=','tbl_score_details.score_id')
                     ->where('tbl_scores.id_score','=',$id)
                     ->get();

        return view('v_admin.detail_score', compact('score','workarea','detail_sp'));

    }

    public function updateScore(Request $request, $id)
    {
        //dd($totalscore);
        $score_acc = DB::table('scores')
                     ->where('cleaningservices_id','=', $request->input('cleaningservices_id'))
                     ->where(DB::raw("(DATE_FORMAT(score_dt, '%m'))"),'=', date('m', strtotime(now())))
                     ->sum('total_score');

        $pengawasid     = Auth::id();
        $score          = ScoreModel::find($id);
        $totalscore     = array_sum($request->get('score'));
        //$new_score_acc  = $request->get('total_score') - $totalscore;
        
        
        $score->user_id                     = $pengawasid;
        $score->cleaningservices_id         = $request->get('cleaningservices_id');
        $score->floor_id                    = $request->get('floor_id');
        $score->total_score                 = $totalscore;

        if($totalscore < $request->get('total_score'))
        {
           $score->total_score_accumulation = $score_acc - ($request->get('total_score') - $totalscore);

        }else {
            $score->total_score_accumulation = $score_acc + ($totalscore - $request->get('total_score'));
        }

        $score->status_score                = "Bersih";
        $score->save();

        $criteria_ids = $request->criteria_id;

        foreach ($criteria_ids as $i => $criteria_id) {
            DB::table('detailscores')->where('score_id', $id)->where('criteria_id',$criteria_id)->update([
                'score_id'      => $id,
                'criteria_id'   => $criteria_id,
                'score'         => isset($request->score[$criteria_id]) ? 1 : 0,
                'description'   => $request->description[$i]
            ]);  
        }

        //dd($request->all());
        return redirect('admin-master/show_score')->with('success','Berhasil mengubah penilaian');
    }

    public function showReport()
    {

        $report  = DB::table('tbl_score_details')
                    ->join('tbl_criterias','tbl_criterias.id_criteria','=','tbl_score_details.criteria_id')
                    ->join('tbl_scores', 'tbl_scores.id_score', 'tbl_score_details.score_id')
                    ->join('tbl_employees', 'tbl_employees.id_employee', 'tbl_scores.emp_id')
                    ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', 'tbl_scores.working_area_id')
                    ->join('tbl_users', 'tbl_users.id','tbl_scores.user_id')
                    ->where('score',1)
                    ->get();
        // dd($report);
        return view('v_admin.show_report', compact('report'));
    }

    public function exportScore(Request $request)
    {
        return Excel::download(new ScoreExport($request), 'ReportingScore.xlsx');
        //return view('admin.reporting_score')->with('success', 'Berhasil Export Data Penilaian');
    }



    public function deleteScore($id)
    {
        $detail_score = DB::table('tbl_score_details')->where('score_id', $id)->delete();
        $detail_score = DetailScoreModel::where('score_id', $id);
        $detail_score->delete();

        $score = DB::table('tbl_scores')->where('id_score', $id)->delete();
        $score = ScoreModel::where('id_score', $id);
        $score->delete();

        return redirect('admin-master/show_score_all')->with('delete','Berhasil Menghapus Data');   
    }




    // ================
    // Criteria
    // ================

    public function showCriteria()
    {
        $banquetmm    = DB::table('tbl_criterias')->where('criteria_category','bm')->get();
        $cleanservice = DB::table('tbl_criterias')->where('criteria_category','cs')->get();
        $gardener     = DB::table('tbl_criterias')->where('criteria_category','gd')->get();
        $security     = DB::table('tbl_criterias')->where('criteria_category','sc')->get();
        return view('v_admin.show_criteria', compact('banquetmm','cleanservice','gardener','security'));
    }


    public function uploadCriteria(Request $request)
    {
        Excel::import(new ImportDataCriteria, $request->file('upload-criteria'));
        return redirect('admin-master/show_criteria')->with('success','Berhasil Upload Data Kriteria Penilaian');
    }

    public function addCriteria(Request $request)
    {
        $criteria = new CriteriaModel();
        $criteria->criteria_category = $request->input('criteria_category');
        $criteria->criteria_name     = $request->input('criteria_name');
        $criteria->save();

        return redirect('admin-master/show_criteria')->with('success','Berhasil Menambah Kriteria');
    }

    public function updateCriteria(Request $request, $id)
    {
        $criteria = CriteriaModel::where('id_criteria', $id)
                        ->update([
                            'criteria_category' => $request->criteria_category,
                            'criteria_name'     => $request->criteria_name,
                        ]);

        return redirect('admin-master/show_criteria')->with('success','Berhasil Mengubah Kriteria');
    }
    
}
