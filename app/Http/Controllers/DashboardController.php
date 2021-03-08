<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use App\Models\CandidateComment;
use App\Models\CandidateInfo;
use App\Models\Community;
use App\Models\County;
use App\Models\Educations;
use App\Models\EmployedType;
use App\Models\Payment;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\RehabitationCenter;
use App\Models\ServiceList;
use App\Models\Specialist;
use App\Models\Stage;
use App\Models\Status;
use App\Models\Voivodeship;
use Database\Seeders\EmployedTypeSeeder;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function getList(Request $request) {
        try {

            $query = Candidate::where('status', '=', true);
            $query_participant = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')
                ->leftJoin('rehabitation_centers', 'candidate_infos.rehabitation_center', '=', 'rehabitation_centers.id')
                ->where('candidates.status', '=', true)->where('candidates.is_participant', '=', true);
            $tempQualificationArr = QualificationPoint::where('status', '=', 1)->get();
            $qualificationPoint = [];
            if (Auth::user()->id_role == 3) {
                foreach($tempQualificationArr as $item) {
                    $arr = explode(',', $item->ambassador);
                    if (in_array(Auth::user()->id, $arr)) {
                        $qualificationPoint[] = $item->id;
                    }
                }
                $query->whereIn('qualification_point', $qualificationPoint)->orWhere(function ($q) {
                    $q->orWhere('qualification_point', '=', '')->orWhere('qualification_point', '=', null);
                });
                $query_participant->whereIn('candidates.qualification_point', $qualificationPoint)->orWhere(function ($q) {
                    $q->orWhere('candidates.qualification_point', '=', '')->orWhere('candidates.qualification_point', '=', null);
                })->selectRaw('candidates.*, candidate_infos.*, rehabitation_centers.name as rehabitation_center_name');
            } else {
                $query_participant->selectRaw('candidates.*, candidate_infos.*, rehabitation_centers.name as rehabitation_center_name');
            }

            $candidates = $query
                ->orderBy('created_at', 'desc')
                ->take(7)
                ->get();
            $participants = $query_participant
                ->orderBy('candidates.created_participant_time', 'desc')
                ->take(7)
                ->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [ 'candidates' => $candidates, 'participants' => $participants ]
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

    public function delete(Request $request) {
        try {
            $id = $request->input('id');
            Candidate::where('id', '=', $id)->update(['status' => false]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => DELETE_CANDIDATE_SUCCESS,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
