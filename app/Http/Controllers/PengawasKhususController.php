<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PegawaiModel;
use App\Models\ScoreModel;
use App\Models\DetailScoreModel;
use Carbon\Carbon;
use Auth;
use Validator;
use Session;
use DB;
use Response;


class PengawasKhususController extends Controller
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
                $pc = $data->is_pet_control;
 

                if ($pc == 0){
                    
                    return redirect('login')->with('failed', 'Login gagal!');

                }else{

                    return view('v_pengawas_khusus.index', compact('pegawai','scorecs','scoresc','scorebm','scoregd'));

                }
            }
        }
    }

    // ===============================================
    //                   SCORE
    // ===============================================

    public function showScore()
    {
        $pegawai    = DB::table('tbl_users_access')
                        ->join('tbl_users', 'tbl_users.id', 'tbl_users_access.user_id')
                        ->where('user_id', Auth::user()->id)
                        ->get();

        $score      = DB::table('tbl_score_details')
                        ->join('tbl_scores', 'tbl_scores.id_score', '=', 'tbl_score_details.score_id')
                        ->join('tbl_users', 'tbl_users.id', '=', 'tbl_scores.user_id')
                        ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                        ->join('tbl_working_areas', 'tbl_working_areas.id_working_area', '=', 'tbl_scores.working_area_id')
                        ->where('tbl_scores.user_id', Auth::user()->id)
                        ->orderBy('tbl_scores.score_dt','DESC')
                        ->orderBy('tbl_scores.score_tm','DESC')
                        ->get();
        return view('v_pengawas_khusus/show_score', compact('pegawai','score'));
    }

    public function createScore(Request $request)
    {
        $area       = $request->area;
        $empctg     = $request->emp_category;
        $scorenote  = $request->score_notes;

        $pengawas   = DB::table('tbl_users')
                        ->join('tbl_roles', 'tbl_roles.id_role', '=', 'tbl_users.role_id')
                        ->join('tbl_status', 'tbl_status.id_status', '=', 'tbl_users.status_id')
                        ->where('id', Auth::user()->id)
                        ->get();

        $areadiscov = DB::table('tbl_working_areas')->where('id_working_area', $area)->first();

        if ($empctg == 'pc') {
            $criteria      = DB::table('tbl_criterias')->where('criteria_category', 'pc')->get();
        }
        
        return view('v_pengawas_khusus/create_score',compact('pengawas','areadiscov','criteria', 'scorenote'));
    }

    public function addScore(Request $request)
    {
        $pengawasid = Auth::id();
        $score_acc  = DB::table('tbl_scores')
                        ->where('emp_id', '=', $request->input('emp_id'))
                        ->where(DB::raw("(DATE_FORMAT(score_dt, '%m'))"), '=', date('m', strtotime(now())))
                        ->sum('total_score');
        $scoreid          = DB::table('tbl_scores')->count();
        $detailscoreid    = DB::table('tbl_score_details')->count();

		$validation  = Validator::make($request->all(), [
			'img_discovery'    => 'mimes:png,jpg,jpeg |max:4096',
		]);

        if ($validation->fails()) {
            return redirect('pengawas-khusus/dashboard/')->with('failed', 'Kode Barang telah terdaftar');
        }else{
            $score                              = new ScoreModel();
            $score->user_id                     = $pengawasid;
            $score->working_area_id             = $request->input('working_area_id');
            $score->score_notes                 = $request->input('score_notes');
            $score->score_tm                    = Carbon::now();
            $score->score_dt                    = Carbon::now();
            $score->save();

            $getscoreid = DB::table('tbl_scores')->select('id_score')->orderBy('id_score', 'DESC')->first();
            $detailscore = new DetailScoreModel();
            $detailscore->score_id = $getscoreid->id_score;
            $detailscore->criteria_id     = $request->input('criteria_id');
            $detailscore->description     = $request->input('description');


            if ($request->hasfile('img_discovery')) {
                $file = $request->file('img_discovery');
                $extension = $file->getClientOriginalExtension();
                $imgdiscov = time() . '.' . $extension;
                $file->move('assets/img/temuan-hewan/', $imgdiscov);
                $detailscore->img_discovery = $imgdiscov;
            } else {
                return $request;
                $detailscore->image = '';
            }

            $detailscore->save();
            
            return redirect('pengawas-khusus/show_score/')->with('success', 'Berhasil menambahkan temuan');
        }
    }

    // ===============================================
    //                   JAVASCRIPT
    // ===============================================


    public function getArea(Request $request)
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

    // ===============================================
    //                   CHART
    // ===============================================

    public function chartDiscovery()
    {

        $result = DB::table('tbl_scores')
                            ->select('working_area_name', DB::raw('count(id_score) as totaldiscovery'))
                            ->join('tbl_working_areas','tbl_working_areas.id_working_area','tbl_scores.working_area_id')
                            ->where('user_id', Auth::user()->id)
                            ->groupBy('working_area_name')
                            ->get();

        return response()->json($result);
    }

}