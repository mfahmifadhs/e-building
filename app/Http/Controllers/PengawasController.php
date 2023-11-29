<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PegawaiModel;
use App\Models\ScoreModel;
use App\Models\DetailScoreModel;
use Carbon\Carbon;
use Auth;
use Hash;
use Session;
use DB;
use Response;


class PengawasController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $today = date('Y-m-d', strtotime(now()));
        $month = date('m', strtotime(now()));
        
        $cekaccess = DB::table('tbl_users_access')
                        ->join('tbl_users','tbl_users.id','tbl_users_access.user_id')
                        ->where('user_id', Auth::user()->id)
                        ->count();
        
        if ($cekaccess == 0) {
            return redirect('login')->with('failed','Anda tidak memiliki akses!');
        }else{
            $pegawai = DB::table('tbl_users_access')
                        ->join('tbl_users', 'tbl_users.id', 'tbl_users_access.user_id')
                        ->where('user_id', Auth::user()->id)
                        ->get();

            $scorecs    = DB::table('tbl_scores')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where('tbl_scores.user_id', $id)
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                            ->where('emp_category','CS')
                            ->orderBy('tbl_scores.score_dt','DESC')
                            ->orderBy('tbl_scores.score_tm','DESC')
                            ->get();

            $scoresc    = DB::table('tbl_scores')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where('tbl_scores.user_id', $id)
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                            ->where('emp_category','SC')
                            ->orderBy('tbl_scores.score_dt','DESC')
                            ->orderBy('tbl_scores.score_tm','DESC')
                            ->get();

            $scorebm    = DB::table('tbl_scores')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where('tbl_scores.user_id', $id)
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                            ->where('emp_category','BQ')
                            ->orWhere('emp_category','MM')
                            ->orderBy('tbl_scores.score_dt','DESC')
                            ->orderBy('tbl_scores.score_tm','DESC')
                            ->get();

            $scoregd    = DB::table('tbl_scores')
                            ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                            ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                            ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                            ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                            ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                            ->where('tbl_scores.user_id', $id)
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                            ->where('emp_category','GD')
                            ->orderBy('tbl_scores.score_dt','DESC')
                            ->orderBy('tbl_scores.score_tm','DESC')
                            ->get();

            foreach($pegawai as $data){
                $bm = $data->is_banquet_multimedia;
                $cs = $data->is_cleaning_service;
                $gd = $data->is_gardener;
                $sc = $data->is_security;
 

                if ($bm == 0 & $cs == 0 & $gd == 0 & $sc == 0){
                    
                    return redirect('login')->with('failed', 'Login gagal!');

                }else{

                    return view('v_pengawas.index', compact('pegawai','scorecs','scoresc','scorebm','scoregd'));

                }
            }
        }
    }

    // ==================================
    // PROFILE
    // ==================================

    public function showProfile()
    {
        $access     = DB::table('tbl_users_access')
                        ->join('tbl_users', 'tbl_users.id', 'tbl_users_access.user_id')
                        ->where('user_id', Auth::user()->id)
                        ->get();

        $pengawas   = DB::table('tbl_users')
                        ->join('tbl_status', 'tbl_status.id_status', 'tbl_users.status_id')
                        ->where('id', Auth::user()->id)
                        ->get();

        return view('v_pengawas.show_profile', compact('pengawas','access'));
    }

    public function changePassword(Request $request)
    {
        $id = Auth::user()->id;
        $hashedPassword = Auth::user()->password;

        if(\Hash::check($request->old_password, $hashedPassword)){
            $newpass    = User::where('id', $id)
                            ->update([
                                'password' => Hash::make($request->new_password)
                            ]);

            return redirect('signout')->with('success','Berhasil mengubah password');
        }else{
            return redirect('pengawas/show_profile')->with('failed', 'Password Lama Anda Salah');
        }
    }

    public function changeProfile(Request $request)
    {
        $id = Auth::user()->id;
        $cekuser = DB::table('tbl_users')->where('username', $request->username)->count();


        if($cekuser == 1)
        {
            return redirect('pengawas/show_profile')->with('failed', 'Username Telah Terdaftar');
        }elseif($request->username == null)
        {
            $user   = User::where('id', $id)
                            ->update([
                                'name'      => $request->name,
                                'username'  => Auth::user()->username,
                                'status_id' => $request->status_id
                            ]);

            return redirect('pengawas/show_profile')->with('success','Berhasil Mengubah Data Profil');
        }else{
            $user   = User::where('id', $id)
                            ->update([
                                'name'      => $request->name,
                                'username'  => $request->username,
                                'status_id' => $request->status_id
                            ]);

            return redirect('pengawas/show_profile')->with('success','Berhasil Mengubah Data Profil');
        }

    }

    // ==================================
    // PEGAWAI
    // ==================================

    public function showPegawai()
    {
        $pegawai = DB::table('tbl_users_access')
                        ->join('tbl_users', 'tbl_users.id', 'tbl_users_access.user_id')
                        ->where('user_id', Auth::user()->id)
                        ->get();

        foreach($pegawai as $data){
                $bm = $data->is_banquet_multimedia;
                $cs = $data->is_cleaning_service;
                $gd = $data->is_gardener;
                $sc = $data->is_security;
 

                if ($bm == 1 & $cs == 0 & $gd == 0 & $sc == 0){
                    
                    $pegawai  = DB::table('tbl_employees')->where('emp_category','bq')->orWhere('emp_category','mm')
                                ->join('tbl_status','tbl_status.id_status','tbl_employees.status_id')->get();

                }elseif($bm == 0 & $cs == 1 & $gd == 0 & $sc == 0){

                    $pegawai  = DB::table('tbl_employees')->where('emp_category','cs')
                                ->join('tbl_status','tbl_status.id_status','tbl_employees.status_id')->get();

                }elseif($bm == 0 & $cs == 0 & $gd == 0 & $sc == 1){

                    $pegawai  = DB::table('tbl_employees')->where('emp_category','sc')
                                ->join('tbl_status','tbl_status.id_status','tbl_employees.status_id')->get();

                }elseif($bm == 0 & $cs == 0 & $gd == 1 & $sc == 0){

                    $pegawai  = DB::table('tbl_employees')->where('emp_category','sc')
                                ->join('tbl_status','tbl_status.id_status','tbl_employees.status_id')->get();

                }else{
                    $pegawai  = DB::table('tbl_employees')
                                ->join('tbl_status','tbl_status.id_status','tbl_employees.status_id')->get();
                }
            }

        return view('v_pengawas.show_pegawai', compact('pegawai'));
    }


    // ==================================
    // CRITERIA
    // ==================================

    public function showCriteria()
    {

        $pegawai = DB::table('tbl_users_access')
                    ->join('tbl_users', 'tbl_users.id', 'tbl_users_access.user_id')
                    ->where('user_id', Auth::user()->id)
                    ->get();

        $banquetmm    = DB::table('tbl_criterias')->where('criteria_category','bm')->get();
        $cleanservice = DB::table('tbl_criterias')->where('criteria_category','cs')->get();
        $gardener     = DB::table('tbl_criterias')->where('criteria_category','gd')->get();
        $security     = DB::table('tbl_criterias')->where('criteria_category','sc')->get();
        return view('v_pengawas.show_criteria', compact('pegawai','banquetmm','cleanservice','gardener','security'));
    }


    // ==================================
    // SCORING
    // ==================================

    public function showScore(Request $request)
    {
        $id = Auth::id();
        $today = date('Y-m-d', strtotime(now()));
        $month = date('m', strtotime(now()));
        $pegawai = DB::table('tbl_users_access')
                    ->join('tbl_users', 'tbl_users.id', 'tbl_users_access.user_id')
                    ->where('user_id', Auth::user()->id)
                    ->get();

        if($request->start_dt != null && $request->end_dt != null && $request->emp_category == null){
            $score      = DB::table('tbl_scores')
                          ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                          ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                          ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                          ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                          ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                          ->whereBetween('score_dt', [$request->start_dt, $request->end_dt])
                          ->where('tbl_scores.user_id', $id)
                          ->orderBy('tbl_scores.score_dt','DESC')
                          ->orderBy('tbl_scores.score_tm','DESC')
                          ->get();

        }elseif($request->emp_category != null){
            if($request->emp_category == 'bm')
                $score      = DB::table('tbl_scores')
                              ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                              ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                              ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                              ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                              ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                              ->where('emp_category', 'bq')
                              ->orWhere('emp_category', 'mm')
                              ->where('tbl_scores.user_id', $id)
                              ->orderBy('tbl_scores.score_dt','DESC')
                              ->orderBy('tbl_scores.score_tm','DESC')
                              ->get();
            else{
                $score      = DB::table('tbl_scores')
                              ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                              ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                              ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                              ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                              ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                              ->where('emp_category', $request->emp_category)
                              ->where('tbl_scores.user_id', $id)
                              ->orderBy('tbl_scores.score_dt','DESC')
                              ->orderBy('tbl_scores.score_tm','DESC')
                              ->get(); 
            }

        }elseif($request->start_dt != null && $request->end_dt != null && $request->emp_category != null){
            if($request->emp_category == 'bm')
                $score      = DB::table('tbl_scores')
                              ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                              ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                              ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                              ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                              ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                              ->where('emp_category', 'bq')
                              ->orWhere('emp_category', 'mm')
                              ->whereBetween('score_dt', [$request->start_dt, $request->end_dt])
                              ->where('tbl_scores.user_id', $id)
                              ->orderBy('tbl_scores.score_dt','DESC')
                              ->orderBy('tbl_scores.score_tm','DESC')
                              ->get();
            else{
                $score      = DB::table('tbl_scores')
                              ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                              ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                              ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                              ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                              ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                              ->where('emp_category', $request->emp_category)
                              ->whereBetween('score_dt', [$request->start_dt, $request->end_dt])
                              ->where('tbl_scores.user_id', $id)
                              ->orderBy('tbl_scores.score_dt','DESC')
                              ->orderBy('tbl_scores.score_tm','DESC')
                              ->get(); 
            }
        }else{
            $score      = DB::table('tbl_scores')
                          ->join('tbl_employees', 'tbl_employees.id_employee', '=', 'tbl_scores.emp_id')
                          ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                          ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                          ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                          ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                          ->where('tbl_scores.user_id', $id)
                          ->orderBy('tbl_scores.score_dt','DESC')
                          ->orderBy('tbl_scores.score_tm','DESC')
                          ->get();
        }

        return view('v_pengawas.show_score', compact('score','pegawai'));
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

        return view('v_pengawas.detail_score', compact('score','workarea','detail_sp'));

    }

    public function createScore(Request $request)
    {
        $emp_id     = $request->id_employee;
        $workarea   = $request->working_area;
        $empctg     = $request->emp_category;
        $scorenote  = $request->score_notes;

        $pegawai    = DB::table('tbl_employees')
                        ->join('tbl_users', 'tbl_users.id', '=', 'tbl_employees.user_id')
                        ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                        ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_employees.status_id')
                        ->where('tbl_employees.id_employee', '=', $emp_id)
                        ->get();
        $workingarea   = DB::table('tbl_working_areas')->where('id_working_area', $workarea)->first();

        if ($empctg == 'bq' || $empctg == 'mm') {
            $criteria      = DB::table('tbl_criterias')->where('criteria_category', 'bm')->get();
        }else{  
            $criteria      = DB::table('tbl_criterias')->where('criteria_category', $empctg)->get();
        }

        
        return view('v_pengawas/create_score',compact('pegawai','workingarea','criteria', 'scorenote'));
    }

    public function addScore(Request $request)
    {
        $pengawasid = Auth::id();
        $score_acc  = DB::table('tbl_scores')
                        ->where('emp_id','=', $request->input('emp_id'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%m'))"),'=', date('m', strtotime(now())))
                        ->sum('total_score');
        $scoreid          = DB::table('tbl_scores')->count();
        $detailscoreid    = DB::table('tbl_score_details')->count();

        $score                              = new ScoreModel();
        $score->id_score                    = $scoreid+1;
        $totalscore                         = array_sum($request->input('score'));
        $totalscoreacc                      = $score_acc + $totalscore;
        $score->user_id                     = $pengawasid;
        $score->emp_id                      = $request->input('emp_id');
        $score->working_area_id             = $request->input('working_area_id');
        $score->total_score                 = $totalscore;
        $score->total_score_accumulation    = $totalscoreacc;
        $score->score_notes                 = $request->input('score_notes');
        $score->score_tm                    = Carbon::now();
        $score->score_dt                    = Carbon::now();
        $score->save();


        $getscoreid = DB::table('tbl_scores')->select('id_score')->orderBy('id_score', 'DESC')->first();

        $criteria_ids = $request->criteria_id;
        $score_ids = $request->score;
        foreach ($criteria_ids as $i => $criteria_id) {
             $score_detail[] = [
                'id_score_detail'   => $detailscoreid[$i],  
                'score_id'          => $getscoreid->id_score,
                'criteria_id'       => $criteria_id,
                'score'             => isset($request->score[$criteria_id]) ? 1 : 0,
                'description'       => $request->description[$i]
             ];
          }

        DetailScoreModel::insert($score_detail);
        return redirect('pengawas/show_score')->with('success','Berhasil memberikan penilaian');
    }


    // ==================================
    // SELECT 2
    // ==================================


    public function getEmpCategory(Request $request)
    {
        $empcategory = DB::table('tbl_employees')
                        ->where('emp_category', $request->empcategory)
                        ->pluck('id_employee','emp_name');
        return response()->json($empcategory);
    } 

    public function getWorkArea(Request $request)
    {
        $workarea = DB::table('tbl_working_areas')
                        ->where('working_area_category', $request->workarea)
                        ->pluck('id_working_area','working_area_name');
        return response()->json($workarea);
    } 

    public function getWorkAreaAllBM(Request $request)
    {
        $workarea = DB::table('tbl_working_areas')
                        ->where('working_area_category', 'BM')
                        ->pluck('id_working_area','working_area_name');
        return response()->json($workarea);
    } 

    public function getWorkAreaBm(Request $request)
    {
        $search = $request->search;

            if($search == ''){
                $cs = DB::table('tbl_working_areas')
                                ->orderby('working_area_name','asc')
                                ->select('id_working_area','working_area_name')
                                ->where('working_area_category', 'BM')
                                ->get();
            }else{
                $cs = DB::table('tbl_working_areas')
                                ->orderby('working_area_name','asc')
                                ->select('id_working_area','working_area_name')
                                ->where('working_area_name', 'like', '%' .$search . '%')
                                ->where('working_area_category', 'BM')
                               ->get();
            }

            $response = array();
            foreach($cs as $data){
                $response[] = array(
                    "id"    =>  $data->id_working_area,
                    "text"  =>  $data->working_area_name
                );
            }

            return response()->json($response);
    } 

    public function getWorkAreaCs(Request $request)
    {
        $search = $request->search;

            if($search == ''){
                $cs = DB::table('tbl_working_areas')
                                ->orderby('working_area_name','asc')
                                ->select('id_working_area','working_area_name')
                                ->where('working_area_category', 'CS')
                                ->get();
            }else{
                $cs = DB::table('tbl_working_areas')
                                ->orderby('working_area_name','asc')
                                ->select('id_working_area','working_area_name')
                                ->where('working_area_name', 'like', '%' .$search . '%')
                                ->where('working_area_category', 'CS')
                               ->get();
            }

            $response = array();
            foreach($cs as $data){
                $response[] = array(
                    "id"    =>  $data->id_working_area,
                    "text"  =>  $data->working_area_name
                );
            }

            return response()->json($response);
    }

    public function getWorkAreaGd(Request $request)
    {
        $search = $request->search;

            if($search == ''){
                $cs = DB::table('tbl_working_areas')
                                ->orderby('working_area_name','asc')
                                ->select('id_working_area','working_area_name')
                                ->where('working_area_category', 'GD')
                                ->get();
            }else{
                $cs = DB::table('tbl_working_areas')
                                ->orderby('working_area_name','asc')
                                ->select('id_working_area','working_area_name')
                                ->where('working_area_name', 'like', '%' .$search . '%')
                                ->where('working_area_category', 'GD')
                               ->get();
            }

            $response = array();
            foreach($cs as $data){
                $response[] = array(
                    "id"    =>  $data->id_working_area,
                    "text"  =>  $data->working_area_name
                );
            }

            return response()->json($response);
    }

    public function getWorkAreaSc(Request $request)
    {
        $search = $request->search;

            if($search == ''){
                $cs = DB::table('tbl_working_areas')
                                ->orderby('working_area_name','asc')
                                ->select('id_working_area','working_area_name')
                                ->where('working_area_category', 'SC')
                                ->get();
            }else{
                $cs = DB::table('tbl_working_areas')
                                ->orderby('working_area_name','asc')
                                ->select('id_working_area','working_area_name')
                                ->where('working_area_name', 'like', '%' .$search . '%')
                                ->where('working_area_category', 'SC')
                                ->get();
            }

            $response = array();
            foreach($cs as $data){
                $response[] = array(
                    "id"    =>  $data->id_working_area,
                    "text"  =>  $data->working_area_name
                );
            }

            return response()->json($response);
    }

    public function getCleaningService(Request $request)
    {
        $search = $request->search;

            if($search == ''){
                $cleanservice = DB::table('tbl_employees')
                                ->orderby('emp_name','asc')
                                ->select('id_employee','emp_name')
                                ->where('emp_category', 'cs')
                                ->where('status_id', 1)
                                ->where('emp_position','CLEANER')
                                ->limit(3)->get();
            }else{
                $cleanservice = DB::table('tbl_employees')
                                ->orderby('emp_name','asc')
                                ->select('id_employee','emp_name')
                                ->where('emp_name', 'like', '%' .$search . '%')
                                ->where('emp_category', 'cs')
                                ->where('status_id', 1)
                                ->where('emp_position','CLEANER')
                                ->limit(5)->get();
            }

            $response = array();
            foreach($cleanservice as $data){
                $response[] = array(
                    "id"    =>  $data->id_employee,
                    "text"  =>  $data->emp_name
                );
            }

            return response()->json($response);
    }

    public function getSecurity(Request $request)
    {
        $search = $request->search;

            if($search == ''){
                $security = DB::table('tbl_employees')
                                ->orderby('emp_name','asc')
                                ->select('id_employee','emp_name')
                                ->where('emp_category', 'sc')
                                ->where('status_id', 1)
                                ->limit(3)->get();
            }else{
                $security = DB::table('tbl_employees')
                                ->orderby('emp_name','asc')
                                ->select('id_employee','emp_name')
                                ->where('emp_name', 'like', '%' .$search . '%')
                                ->where('emp_category', 'sc')
                                ->where('status_id', 1)
                                ->limit(5)->get();
            }

            $response = array();
            foreach($security as $data){
                $response[] = array(
                    "id"    =>  $data->id_employee,
                    "text"  =>  $data->emp_name
                );
            }

            return response()->json($response);
    }

    public function getGardener(Request $request)
    {
        $search = $request->search;

            if($search == ''){
                $gardener = DB::table('tbl_employees')
                                ->orderby('emp_name','asc')
                                ->select('id_employee','emp_name')
                                ->where('emp_category', 'gd')
                                ->where('status_id', 1)
                                ->where('emp_position','GARDENER')
                                ->limit(3)->get();
            }else{
                $gardener = DB::table('tbl_employees')
                                ->orderby('emp_name','asc')
                                ->select('id_employee','emp_name')
                                ->where('emp_name', 'like', '%' .$search . '%')
                                ->where('emp_category', 'gd')
                                ->where('status_id', 1)
                                ->where('emp_position','GARDENER')
                                ->limit(5)->get();
            }

            $response = array();
            foreach($gardener as $data){
                $response[] = array(
                    "id"    =>  $data->id_employee,
                    "text"  =>  $data->emp_name
                );
            }

            return response()->json($response);
    }

    public function getBanquetMM(Request $request)
    {
        $search = $request->search;

            if($search == ''){
                $banquetmm  = DB::table('tbl_employees')
                                ->orderby('emp_name','asc')
                                ->select('id_employee','emp_name')
                                ->where('emp_category', 'bq')
                                ->orWhere('emp_category', 'mm')
                                ->where('status_id', 1)
                                ->limit(3)->get();
            }else{
                $banquetmm  = DB::table('tbl_employees')
                                ->orderby('emp_name','asc')
                                ->select('id_employee','emp_name')
                                ->where('emp_name', 'like', '%' .$search . '%')
                                ->where('emp_category', 'bq')
                                ->orWhere('emp_category', 'mm')
                                ->where('status_id', 1)
                                ->limit(5)->get();
            }

            $response = array();
            foreach($banquetmm as $data){
                $response[] = array(
                    "id"    =>  $data->id_employee,
                    "text"  =>  $data->emp_name
                );
            }

            return response()->json($response);
    }

    // ================
    // Chart 
    // ================

    public function getChartCS()
    {

        $result = DB::table('tbl_score_details')->select(DB::raw('sum(score) as totalscoreall'))->first();

        $result = DB::table('tbl_score_details')
                      ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                      ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                      ->select('tbl_criterias.criteria_name', DB::raw("Sum(score) as totalscore "), DB::raw('count(score) as totalscoreall'))
                      ->where('criteria_category', 'CS')
                      ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                      ->groupBy('tbl_criterias.criteria_name')
                      ->orderBy('totalscore', 'DESC')
                      ->get();

        return response()->json($result);
    }

    public function getChartSC()
    {
        $result     = DB::table('tbl_score_details')
                      ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                      ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                      ->select('tbl_criterias.criteria_name', DB::raw("Sum(score) as totalscore "), DB::raw('sum(score) as totalscoreall'))
                      ->where('criteria_category', 'SC')
                      ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                      ->groupBy('criteria_name')
                      ->orderBy('totalscore', 'DESC')
                      ->get();

        return Response::json($result);
    }

    public function getChartBM()
    {
        $result     = DB::table('tbl_score_details')
                      ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                      ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                      ->select('tbl_criterias.criteria_name', DB::raw("Sum(score) as totalscore "), DB::raw('sum(score) as totalscoreall'))
                      ->where('criteria_category', 'BM')
                      ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                      ->groupBy('criteria_name')
                      ->orderBy('totalscore', 'DESC')
                      ->get();

        return Response::json($result);
    }

    public function getChartGD()
    {
        $result     = DB::table('tbl_score_details')
                      ->join('tbl_scores','tbl_scores.id_score','tbl_score_details.score_id')
                      ->join('tbl_criterias','tbl_criterias.id_criteria','tbl_score_details.criteria_id')
                      ->select('tbl_criterias.criteria_name', DB::raw("Sum(score) as totalscore "), DB::raw('sum(score) as totalscoreall'))
                      ->where('criteria_category', 'GD')
                      ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                      ->groupBy('criteria_name')
                      ->orderBy('totalscore', 'DESC')
                      ->get();

        return Response::json($result);
    }
}
