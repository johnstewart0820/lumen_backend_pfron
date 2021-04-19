<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use App\Models\CandidateInfo;
use App\Models\Ipr;
use App\Models\IprPlan;
use App\Models\Module;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\RehabitationCenter;
use App\Models\RehabitationCenterPartner;
use App\Models\RehabitationCenterQuater;
use App\Models\Specialist;
use App\Models\SpecialtyType;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getServiceInfo(Request $request) {
        try {
            $rehabitation_center = RehabitationCenter::all();
            $participant = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')
                ->where('candidates.is_participant', '=', 1)
                ->selectRaw('CONCAT(candidates.name, " ", candidates.surname, "(", candidate_infos.participant_number, ")") as name, candidates.id, candidate_infos.rehabitation_center')->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'rehabitation_center' => $rehabitation_center,
                    'participant' => $participant,
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getServiceQuater(Request $request) {
        try {
            $rehabitation_center = $request->rehabitation_center;
            $quater = RehabitationCenterQuater::where('center_id', '=', $rehabitation_center)->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'quater' => $quater,
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

    public function getSchedules($query, $index, $id_candidate, $date_from, $date_to) {

        return $query
            ->where('date', '>=', $date_from)
            ->where('date', '<=', $date_to)
            ->whereIn('id_ipr',
                Ipr::where('iprs.id_candidate', '=', $id_candidate)
                    ->where('iprs.status', '=', true)
                    ->where('iprs.ipr_type', '=', $index)
                    ->selectRaw('iprs.id')
                    ->get()
            )->sum('total_amount');
    }

    public function getRecuitment($rehabitation_center, $quater_from, $quater_to, $qualification_point_type) {
        return Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')
            ->leftJoin('qualification_points', 'candidates.qualification_point', '=', 'qualification_points.id')
            ->where('candidate_infos.rehabitation_center', '=', $rehabitation_center)
            ->where('candidates.is_participant', '=', 1)
            ->where('date_referal', '>=', $quater_from)
            ->where('date_referal', '<=', $quater_to)
            ->where('qualification_points.type', '=', $qualification_point_type)
            ->count();
    }

    public function getRecruitmentData(Request $request) {
        try {
            $rehabitation_center = $request->rehabitation_center;
            $quater_from = $request->quater_from;
            $quater_to = $request->quater_to;
            $quater_from_obj = RehabitationCenterQuater::where('id', '=', $quater_from)->first();
            $quater_to_obj = RehabitationCenterQuater::where('id', '=', $quater_to)->first();
            $quater_from_date = $quater_from_obj->start_date;
            $quater_to_date = $quater_to_obj->end_date;

            $count = [];
            $count[] = $this->getRecuitment($rehabitation_center, $quater_from_date, $quater_to_date, 1);
            $count[] = $this->getRecuitment($rehabitation_center, $quater_from_date, $quater_to_date, 2);
            $count[] = $this->getRecuitment($rehabitation_center, $quater_from_date, $quater_to_date, 3);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'count_list' => $count,
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }


    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getServiceData(Request $request) {
        try {
            $rehabitation_center = $request->rehabitation_center;
            $participant = $request->participant;
            $quater_from = $request->quater_from;
            $quater_to = $request->quater_to;
            $module_result = [];
            $candidate_list = [];
            $quater_from_obj = RehabitationCenterQuater::where('id', '=', $quater_from)->first();
            $quater_to_obj = RehabitationCenterQuater::where('id', '=', $quater_to)->first();
            $quater_from_date = $quater_from_obj->start_date;
            $quater_to_date = $quater_to_obj->end_date;

            if ($participant != 0 ) {
                $candidate = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')
                    ->where('candidates.id', '=', $participant)
                    ->selectRaw('candidates.id, candidate_infos.participant_number')->first();
                $candidate_list[] = $candidate;
                $rehabitation_center = CandidateInfo::where('id_candidate', '=', $participant)->first()->rehabitation_center;
            } else {
                $candidate = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')
                    ->where('candidate_infos.rehabitation_center', '=', $rehabitation_center)
                    ->selectRaw('candidates.id, candidate_infos.participant_number')->get();
                $candidate_list = $candidate;
            }
            foreach ($candidate_list as $candidate) {
                $module_result = [];
                $module = Module::all();
                foreach($module as $item) {
                    $item['service_lists'] = $item->service_lists()
                        ->leftJoin('units', 'service_lists.unit', '=', 'units.id')
                        ->leftJoin('payments', 'payments.service', '=', 'service_lists.id')
                        ->where('payments.rehabitation_center', '=', $rehabitation_center)
                        ->selectRaw('service_lists.*, units.name as unit_name, payments.value as cost')->get();
                    foreach($item['service_lists'] as $service_list) {
                        $service_list['schedule'] = (object)[];
                        $service_list['schedule']->trial = $this->getSchedules($service_list->ipr_schedules(), 2, $candidate->id, $quater_from_date, $quater_to_date);
                        $service_list['schedule']->basic = $this->getSchedules($service_list->ipr_schedules(), 3, $candidate->id, $quater_from_date, $quater_to_date);
                    }
                    $module_result[] = $item;
                }

                $candidate['module'] = $module_result;
            }
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'candidate' => $candidate_list,
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }
}
