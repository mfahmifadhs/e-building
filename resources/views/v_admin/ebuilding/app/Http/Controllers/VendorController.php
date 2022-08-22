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


class VendorController extends Controller
{
    public function index()
    {  
        $id = Auth::id();
        // 2021

        $rating21   = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','=','tbl_scores.emp_id')
                        ->select('id_employee','tbl_employees.emp_name', DB::raw("Sum(total_score) as totalscore "))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->where('tbl_employees.user_id', $id)
                        ->orderBy('totalscore','DESC')
                        ->groupBy('emp_name','id_employee')
                        ->get();

        $totalkk21  = DB::table('tbl_scores')
        				->join('tbl_employees', 'tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->where('tbl_employees.user_id', $id)
                        ->first();

        $totalkkm21 = DB::table('tbl_scores')
        				->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw("(DATE_FORMAT(score_dt, '%M')) as month"), DB::raw('sum(total_score) as totalscore21'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->where('tbl_employees.user_id', $id)
                        ->orderBy(DB::raw("(DATE_FORMAT(score_dt, '%m'))", 'ASC'))
                        ->groupBy(DB::raw("(DATE_FORMAT(score_dt, '%M'))"))
                        ->get();

        $score21    = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','=','tbl_scores.emp_id')
                        ->join('tbl_users','tbl_users.id','=','tbl_scores.user_id')
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->where('tbl_employees.user_id', $id)
                        ->orderBy('score_dt','DESC')
                        ->get();

        // 2022
        $month_now  = Carbon::now()->isoFormat('Y-MM');
        $month      = Carbon::now()->isoFormat('MMMM');

        $banquetmm      = DB::table('tbl_employees')->where('emp_category','bq')->orWhere('emp_category','mm')
                          ->where('status_id', 1)->count();
        $cleanservice   = DB::table('tbl_employees')->where('emp_category','cs')->where('status_id', 1)->count();
        $gardener       = DB::table('tbl_employees')->where('emp_category','gd')->where('status_id', 1)->count();
        $security       = DB::table('tbl_employees')->where('emp_category','sc')->where('status_id', 1)->count();
        $user_id        = DB::table('tbl_users')->select('id')->orderby('id', 'DESC')->first();

        $score_acc  = DB::table('tbl_scores')->select(DB::raw("Sum(total_score_accumulation) as totalscore "))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%m'))"), $month_now)->get();
        $check_acc  = DB::table('tbl_scores')->select("total_score_accumulation")->count();

        
        $totalkk22  = DB::table('tbl_scores')
        				->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('tbl_employees.user_id', $id)
                        ->first();

        $totalkkm22 = DB::table('tbl_scores')
        				->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw("(DATE_FORMAT(score_dt, '%M')) as month"), DB::raw('sum(total_score) as totalscore21'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('tbl_employees.user_id', $id)
                        ->orderBy(DB::raw("(DATE_FORMAT(score_dt, '%m'))", 'ASC'))
                        ->groupBy(DB::raw("(DATE_FORMAT(score_dt, '%M'))"))
                        ->get();

        $rating     = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','=','tbl_scores.emp_id')
                        ->select('id_employee','tbl_employees.emp_name', DB::raw("Sum(total_score) as totalscore "))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y-%m'))"), $month_now)
                        ->where('tbl_employees.user_id', $id)
                        ->orderBy('totalscore','DESC')
                        ->groupBy('emp_name','id_employee')
                        ->get();

        $pegawaiall = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','=','tbl_scores.emp_id')
                        ->select('id_employee','emp_name','score_dt','score_tm',
                         DB::raw("Sum(total_score_accumulation) as totalscore "))
                        ->orderBy('totalscore','DESC')
                        ->groupBy('emp_name','id_employee','score_dt','score_tm')
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%m'))"), $month_now)
                        ->where('tbl_employees.user_id', $id)
                        ->get();

        $score22 = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','=','tbl_scores.emp_id')
                        ->join('tbl_users','tbl_users.id','=','tbl_scores.user_id')
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y-%m'))"), $month_now)
                        ->where('tbl_employees.user_id', $id)
                        ->orderBy('score_dt','DESC')
                        ->get();
        

        return view('v_vendor.index', compact('banquetmm','cleanservice','gardener','security','pegawaiall','month','score_acc','check_acc',
                                             'rating','score22','totalkk22','totalkkm22','rating21','totalkk21','totalkkm21','score21'));
        return redirect("login")->with('failed', 'You are not allowed to access');
    }


    // ================
    // PAGE SCORE
    // ================

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

        return view('v_vendor.detail_score', compact('score','workarea','detail_sp'));

    }


    public function showScoreAll(Request $request)
    {
        $id = Auth::id();
        $today = date('Y-m-d', strtotime(now()));
        $month = date('m', strtotime(now()));

        if($request->start_dt != null && $request->end_dt != null){
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
                        ->where('tbl_employees.user_id', $id)
                        ->where('score',1)
                        ->get();

        }elseif($request->start_dt != null && $request->end_dt != null){
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
                            ->where('tbl_employees.user_id', $id)
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
                            ->where('tbl_employees.user_id', $id)
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
                        ->where('tbl_employees.user_id', $id)
                        ->where('score',1)
                        ->get();
        }

        return view('v_vendor.show_score_all', compact('score'));
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
                        ->where('tbl_employees.user_id', $id)
                        ->where('tbl_scores.emp_id', $id)
                        ->get();

        $pegawai    = DB::table('tbl_scores')
                      ->join('tbl_employees', 'tbl_employees.id_employee', 'tbl_scores.emp_id')
                      ->select('emp_name', DB::raw('sum(total_score) as totalscore'))
                      ->where('tbl_employees.id_employee',$id)
                      ->groupBy('emp_name')->get();
        return view('v_vendor.show_score_person', compact('score','pegawai'));
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
                        ->where('tbl_employees.user_id', $id)
                        ->where('tbl_scores.emp_id', $id)
                        ->get();

        $pegawai    = DB::table('tbl_scores')
                        ->join('tbl_employees', 'tbl_employees.id_employee', 'tbl_scores.emp_id')
                        ->select('emp_name', DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->where('tbl_employees.id_employee',$id)
                        ->where('tbl_employees.user_id', $id)
                        ->groupBy('emp_name')->get();
        return view('v_vendor.show_score_person', compact('score','pegawai'));
    }

    public function showScoreMonth22($id)
    {
        if($id == 2022){
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
                            ->where('tbl_employees.user_id', Auth::user()->id)
                            ->orderBy('score_dt','DESC')
                            ->get();

            $pegawai    = DB::table('tbl_scores')
                          ->join('tbl_employees', 'tbl_employees.id_employee', 'tbl_scores.emp_id')
                          ->select('emp_name', DB::raw('sum(total_score) as totalscore'))
                          ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
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
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                            ->where(DB::raw("(DATE_FORMAT(score_dt, '%M'))"), $id)
                            ->where('score',1)
                            ->where('tbl_employees.user_id', Auth::user()->id)
                            ->orderBy('score_dt','DESC')
                            ->get();

            $pegawai    = DB::table('tbl_scores')
                          ->join('tbl_employees', 'tbl_employees.id_employee', 'tbl_scores.emp_id')
                          ->select('emp_name', DB::raw('sum(total_score) as totalscore'))
                          ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                          ->where(DB::raw("(DATE_FORMAT(score_dt, '%M'))"), $id)
                          ->orderBy('score_dt','DESC')
                          ->groupBy('emp_name')->get();
        }
        
        return view('v_vendor.show_score_all', compact('score','pegawai'));
    }

    public function showScoreMonth21($id)
    {
        if ($id == 2021) {
            $score = DB::table('tbl_score_details')
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
                        ->where('tbl_employees.user_id', Auth::user()->id)
                        ->get();

            $pegawai = DB::table('tbl_scores')
                        ->join('tbl_employees', 'tbl_employees.id_employee', 'tbl_scores.emp_id')
                        ->select('emp_name', DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->orderBy('score_dt','DESC')
                        ->groupBy('emp_name')->get();
        }else{
            $score = DB::table('tbl_score_details')
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
                        ->where('tbl_employees.user_id', Auth::user()->id)
                        ->get();

            $pegawai = DB::table('tbl_scores')
                        ->join('tbl_employees', 'tbl_employees.id_employee', 'tbl_scores.emp_id')
                        ->select('emp_name', DB::raw('sum(total_score) as totalscore'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%M'))"), $id)
                        ->orderBy('score_dt','DESC')
                        ->groupBy('emp_name')->get();
        }

        return view('v_vendor.show_score_all', compact('score','pegawai'));
    }


    // ==================================
    // CRITERIA
    // ==================================

    public function showCriteria()
    {

        $pegawai = DB::table('tbl_users')
                    ->where('id', Auth::user()->id)
                    ->get();
                        
        $banquetmm    = DB::table('tbl_criterias')->where('criteria_category','bm')->get();
        $cleanservice = DB::table('tbl_criterias')->where('criteria_category','cs')->get();
        $gardener     = DB::table('tbl_criterias')->where('criteria_category','gd')->get();
        $security     = DB::table('tbl_criterias')->where('criteria_category','sc')->get();
        return view('v_vendor.show_criteria', compact('pegawai','banquetmm','cleanservice','gardener','security'));
    }

    // ================
    // CHART 
    // ================

    public function getChartRating2022()
    {
        $id = Auth::id();
        $month_now  = date('m', strtotime(now()));
        $result     = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw("(DATE_FORMAT(score_dt, '%M')) as month"), DB::raw("Sum(total_score_accumulation) as totalscore "))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2022')
                        ->where('tbl_employees.user_id', $id)
                        ->orderBy('score_dt','ASC')
                        ->groupBy(DB::raw("(DATE_FORMAT(score_dt, '%M'))"))->limit(5)
                        ->get();      

        return response()->json($result);
    }

    public function getChartRating2021()
    {
        $id = Auth::id();
        $result     = DB::table('tbl_scores')
                        ->join('tbl_employees','tbl_employees.id_employee','tbl_scores.emp_id')
                        ->select(DB::raw("(DATE_FORMAT(score_dt, '%M')) as month"), DB::raw("Sum(total_score_accumulation) as totalscore "))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%Y'))"), '2021')
                        ->where('tbl_employees.user_id', $id)
                        ->orderBy('score_dt','ASC')
                        ->groupBy(DB::raw("(DATE_FORMAT(score_dt, '%M'))"))->limit(5)
                        ->get();      

        return response()->json($result);
    }
}
