<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use App\Models\CandidateInfo;
use App\Models\Ipr;
use App\Models\IprPlan;
use App\Models\IprType;
use App\Models\Module;
use App\Models\OrkTeam;
use App\Models\ServiceList;
use Illuminate\Http\Request;

class IprController extends Controller
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
    public function getInfo(Request $request) {
        try {
            $ipr_type = IprType::all();
            $participant = Candidate::leftJoin('candidate_infos', function($join) {
                $join->on('candidates.id', '=', 'candidate_infos.id_candidate');
            })->where('status', '=', true)->where('is_participant', '=', true)->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'ipr_type' => $ipr_type,
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
    public function getOrkPerson(Request $request) {
        try {
            $id = $request->id;
            $count = Ipr::where('id_candidate', '=', $id)->get();
            $rehabitation_center = 0;
            if ($id != 0)
                $rehabitation_center = CandidateInfo::where('id_candidate', '=', $id)->first()->rehabitation_center;
            $ork_person = OrkTeam::where('rehabitation_center', 'LIKE', "%{$rehabitation_center}%")->where('specialization', 'LIKE', "%1%")->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'count' => count($count),
                    'ork_person' => $ork_person
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
    public function get(Request $request) {
        try {
            $id = $request->input('id');
            $ipr = Ipr::find($id);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'ipr' => $ipr
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
    public function getPlanInfo(Request $request) {
        try {
            $id = $request->id;
            $module = Module::where('id', '>', 1)->where('id', '<', 7)->get();
            $plan = IprPlan::leftJoin('service_lists', 'ipr_plans.id_service', '=', 'service_lists.id')
                ->leftJoin('units', 'service_lists.unit', '=', 'units.id')
                ->selectRaw('ipr_plans.*, service_lists.name, service_lists.module, service_lists.amount_usage, service_lists.is_required, service_lists.not_applicable, units.name as unit')
                ->where('ipr_plans.id_ipr', '=', $id)
                ->get();
            $id_candidate = Ipr::where('id', '=', $plan[0]->id_ipr)->first()->id_candidate;
            $rehabitation_center = CandidateInfo::where('id_candidate', '=', $id_candidate)->first()->rehabitation_center;
            $ork_team = OrkTeam::where('rehabitation_center', '=', $rehabitation_center)->where('is_accepted', '=', true)->get();

            foreach($module as $item) {
                $service_list = ServiceList::leftJoin('units', 'service_lists.unit', '=', 'units.id')->where('is_required', '=', false)
                    ->where('status', '=', true)
                    ->where('module', '=', $item->id)
                    ->selectRaw('service_lists.*, units.name as unit')->get();
                $item['ork_team'] = $ork_team;
                $item['service_list'] = $service_list;
            }
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'module' => $module,
                    'plan' => $plan,
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
    public function updatePlan(Request $request) {
        try {
            $moduleList = $request->moduleList;
            $id = $request->id;
            foreach($moduleList as $module) {
                $planList = $module['plan'];
                foreach($planList as $plan) {
                    if (!isset($plan['id_service']))
                        continue;
                    $id_ork_person = '';
                    if (isset($plan['id_ork_person'])) {
                        if (is_integer($plan['id_ork_person']))
                            $id_ork_person = $plan['id_ork_person'];
                        else
                            $id_ork_person = $plan['id_ork_person']['id'];
                    } else
                        $id_ork_person = null;
                    if ($plan['new'] === true) {
                        IprPlan::create(['id_ipr' => $id, 'id_service' => $plan['id_service']['id'], 'amount' => $plan['amount'], 'start_date' => isset($plan['start_date']) ? $plan['start_date'] : null, 'room_number' => $plan['room_number'], 'id_ork_person' => $id_ork_person, 'remarks' => $plan['remarks']]);
                    } else {

                        IprPlan::where('id', '=', $plan['id'])->update(['id_ipr' => $id, 'id_service' => $plan['id_service'], 'amount' => $plan['amount'], 'start_date' => $plan['start_date'], 'room_number' => $plan['room_number'], 'id_ork_person' => $id_ork_person, 'remarks' => $plan['remarks']]);
                    }
                }
            }
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => UPDATE_IPR_SUCCESS
            ]);
        }
    }

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request) {
        try {
            $id_candidate = $request->id_candidate;
            $ipr_type = $request->ipr_type;
            $number = $request->number;
            $schedule_date = $request->schedule_date;
            $ork_person = $request->ork_person;
            $profession = $request->profession;

            $ipr = new Ipr();
            $ipr->id_candidate = $id_candidate;
            $ipr->ipr_type = $ipr_type;
            $ipr->number = $number;
            $ipr->schedule_date = $schedule_date;
            $ipr->id_ork_person = $ork_person;
            $ipr->profession = $profession;
            $ipr->status = true;

            $ipr->save();

            $service_list = ServiceList::where('is_required', '=', true)->where('module', '>', 1)->where('module', '<', 7)->where('status', '=', true)->get();
            foreach($service_list as $service) {
                $item = array('id_ipr' => $ipr->id, 'id_service' => $service->id);
                IprPlan::create($item);
            }



            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => CREATE_IPR_SUCCESS,
                'data' => [
                    'id' => $ipr->id
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
    public function update(Request $request) {
        try {
            $id_candidate = $request->id_candidate;
            $ipr_type = $request->ipr_type;
            $number = $request->number;
            $schedule_date = $request->schedule_date;
            $ork_person = $request->ork_person;
            $profession = $request->profession;
            $id = $request->id;

            Ipr::find($id)->update(['id_candidate' => $id_candidate, 'ipr_type' => $ipr_type, 'number' => $number, 'schedule_date' => $schedule_date, 'id_ork_person' => $ork_person, 'profession' => $profession]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_IPR_SUCCESS,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

    public function getListByOption(Request $request) {
        try {
            $columns = ["id", "name", "ipr_type", "number", "created_at", "schedule_date"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchName = $request->input('searchName');
            $searchIprType = $request->input('searchIprType');
            $searchNumber = $request->input('searchNumber');
            $searchCreatedAt = $request->input('searchCreatedAt');
            $searchScheduleDate = $request->input('searchScheduleDate');

            $iprs = [];
            $iprs_count = 0;
            $query = Ipr::leftJoin('candidates', 'iprs.id_candidate', '=', 'candidates.id')->selectRaw('iprs.*, CONCAT(candidates.name, " ", candidates.surname) as name')
                ->where('name', 'LIKE', "%{$searchName}%")
                ->where('iprs.status', '=', true);
            if ($searchId != '') {
                $query->where('iprs.id', '=', $searchId);
            }
            if (intval($searchIprType) != 0) {
                $query->where('iprs.ipr_type', '=', $searchIprType);
            }
            if ($searchNumber != '') {
                $query->where('iprs.number', 'LIKE', "%{$searchNumber}%");
            }
            if ($searchCreatedAt != '') {
                $query->where('iprs.created_at', 'LIKE', "%{$searchCreatedAt}%");
            }
            if ($searchScheduleDate != '') {
                $query->where('iprs.schedule_date', 'LIKE', "%{$searchScheduleDate}%");
            }
            $iprs_count = $query->get();
            $iprs = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [ 'iprs' => $iprs, 'count' => count($iprs_count) ]
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
            Ipr::where('id', '=', $id)->update(['status' => false]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => DELETE_IPR_SUCCESS,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
