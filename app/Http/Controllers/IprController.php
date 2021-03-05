<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use App\Models\CandidateInfo;
use App\Models\Ipr;
use App\Models\IprPlan;
use App\Models\IprSchedule;
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
    public function getScheduleInfo(Request $request) {
        try {
            $id = $request->input('id');
            $dates = $request->input('dates');
            $service_list = [];
            $module = Module::all();
            $arr = ServiceList::where('module', '=', 1)->get();
            foreach ($arr as $item) {
                $service_list[] = $item;
            }
            $arr = IprPlan::where('id_ipr', '=', $id)->leftJoin('service_lists', 'ipr_plans.id_service', '=', 'service_lists.id')->selectRaw('service_lists.*')->get();
            foreach ($arr as $item) {
                $service_list[] = $item;
            }
            $arr = ServiceList::where('module', '=', 7)->get();
            foreach ($arr as $item) {
                $service_list[] = $item;
            }

            $schedule_list = IprSchedule::where('id_ipr', '=', $id)->where('date', '=', $dates)->get();

            foreach($service_list as $service) {
                foreach($schedule_list as $schedule) {
                    if ($schedule->id_service === $service->id) {
                        $service['schedule'] = $schedule;
                    }
                }
            }
            foreach($module as $item) {
                $_service = [];
                foreach($service_list as $service) {
                    if ($item->id === $service->module) {
                        $_service[] = $service;
                    }
                }
                $item['service_list'] = $_service;
            }

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'module' => $module
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
    public function getWeekStatus(Request $request) {
        try {
            $id = $request->input('id');
            $from = $request->input('from');
            $to = $request->input('to');

            $schedule_list = IprSchedule::where('id_ipr', '=', $id)->where('date', '>', $from)->where('date', '<', $to)->get();
            $status = 0;
            if (count($schedule_list) !== 0) {
                $status = $schedule_list[0]->status;
            }

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'status' => $status
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
                'message' => UPDATE_IPR_SUCCESS,
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
    public function updateSchedule(Request $request) {
        try {
            $scheduleData = $request->schedule_data;
            $date = $request->date;
            $status = $request->status;
            $id = $request->id;

            foreach($scheduleData as $scheduleItem) {
                foreach($scheduleItem['service_list'] as $service) {
                    $break_time = '';
                    $end_time = '';
                    $start_time = '';
                    $total_time = '';
                    $total_amount = '';
                    $id_service = $service['id'];

                    if (!isset($service['schedule'])) {
                        $break_time = '0';
                        $start_time = '00:00';
                        $end_time = '00:00';
                        $total_time = '0';
                        $total_amount = '0';
                    } else {
                        $break_time = isset($service['schedule']['break_time']) ? $service['schedule']['break_time'] : '0';
                        $start_time = isset($service['schedule']['start_time']) ? $service['schedule']['start_time'] : '0';
                        $end_time = isset($service['schedule']['end_time']) ? $service['schedule']['end_time'] : '0';
                        $total_time = isset($service['schedule']['total_time']) ? $service['schedule']['total_time'] : '0';
                        $total_amount = isset($service['schedule']['total_amount']) ? $service['schedule']['total_amount'] : '0';
                    }

                    $list = IprSchedule::where('id_ipr', '=', $id)->where('id_service', '=', $id_service)->where('date', 'LIKE', "%{$date}%")->get();
                    if (count($list) === 0) {
                        IprSchedule::create(['id_ipr' => $id, 'id_service' => $id_service, 'status' => $status, 'date' => $date, 'start_time' => $start_time, 'end_time' => $end_time, 'break_time' => $break_time, 'total_time' => $total_time, 'total_amount' => $total_amount]);
                    } else {
                        IprSchedule::where('id_ipr', '=', $id)->where('id_service', '=', $id_service)->where('date', 'LIKE', "%{$date}%")
                            ->update(['id_ipr' => $id, 'id_service' => $id_service, 'status' => $status, 'date' => $date, 'start_time' => $start_time, 'end_time' => $end_time, 'break_time' => $break_time, 'total_time' => $total_time, 'total_amount' => $total_amount]);
                    }
                }
            }
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