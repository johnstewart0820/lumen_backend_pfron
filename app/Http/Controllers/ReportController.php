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

    public function getSchedules($query, $index, $id_candidate) {
        return $query
            ->whereIn('id_ipr',
                Ipr::where('iprs.id_candidate', '=', $id_candidate)
                    ->where('iprs.status', '=', true)
                    ->where('iprs.ipr_type', '=', $index)
                    ->selectRaw('iprs.id')
                    ->get()
            )->sum('total_amount');
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
            $module_result = [];
            $candidate_list = [];
            if ($rehabitation_center == 0 ) {
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

                $module = Module::all();
                foreach($module as $item) {
                    $item['service_lists'] = $item->service_lists()
                        ->leftJoin('units', 'service_lists.unit', '=', 'units.id')
                        ->leftJoin('payments', 'payments.service', '=', 'service_lists.id')
                        ->where('payments.rehabitation_center', '=', $rehabitation_center)
                        ->selectRaw('service_lists.*, units.name as unit_name, payments.value as cost')->get();
                    foreach($item['service_lists'] as $service_list) {
                        $service_list['schedule'] = (object)[];
                        $service_list['schedule']->trial = $this->getSchedules($service_list->ipr_schedules(), 2, $candidate->id);
                        $service_list['schedule']->basic = $this->getSchedules($service_list->ipr_schedules(), 3, $candidate->id);
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
