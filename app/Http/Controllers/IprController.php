<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use App\Models\CandidateInfo;
use App\Models\Ipr;
use App\Models\IprBalance;
use App\Models\IprPlan;
use App\Models\IprSchedule;
use App\Models\IprType;
use App\Models\Module;
use App\Models\OrkTeam;
use App\Models\ServiceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            })->where('status', '=', true)->where('is_participant', '=', true)->selectRaw('candidates.*, candidate_infos.participant_number')->get();
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

    public function getScheduleForDay($id, $dates) {
        $service_list = [];
        $module = Module::all();
        $arr = ServiceList::where('module', '=', 1)->get();
        foreach ($arr as $item) {
            $service_list[] = $item;
        }
        if (IprSchedule::all()->count() === 0) {
            $arr = IprPlan::where('ipr_plans.id_ipr', '=', $id)
                ->leftJoin('service_lists', 'ipr_plans.id_service', '=', 'service_lists.id')
                ->selectRaw('service_lists.*, ipr_plans.amount as amount')->get();
        } else {
            $arr = IprPlan::where('ipr_plans.id_ipr', '=', $id)
                ->leftJoin('service_lists', 'ipr_plans.id_service', '=', 'service_lists.id')
                ->leftJoin('ipr_schedules', 'ipr_schedules.id_service', '=', 'ipr_plans.id_service', 'ipr_schedules.id_ipr', '=', $id, 'ipr_schedules.date', '!=', $dates)
                ->groupBy('ipr_schedules.id_service')
                ->selectRaw('service_lists.*, ipr_plans.amount as amount, sum(ipr_schedules.total_amount) as current_amount')->get();
        }

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
        return $module;
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

            $module = $this->getScheduleForDay($id, $dates);

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

            $schedule_list = IprSchedule::where('id_ipr', '=', $id)->where('date', '>=', $from)->where('date', '<=', $to)->get();
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
    public function getWeekScheduleInfo(Request $request) {
        try {
            $id = $request->input('id');
            $from = $request->input('from');
            $to = $request->input('to');
            $date = $from;
            $module = [];
            $week_days = [];
            while (strtotime($date) <= strtotime($to)) {
                array_push($week_days, $date);
                $module[] = $this->getScheduleForDay($id, $date);
                $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
            }

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'module' => $module,
                    'week_days' => $week_days
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
                ->selectRaw('ipr_plans.*, service_lists.name, service_lists.number, service_lists.module, service_lists.amount_usage, service_lists.is_required, service_lists.not_applicable, units.name as unit')
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
//                $item['ork_team'] = $ork_team;
                $item['service_list'] = $service_list;
            }
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'module' => $module,
                    'plan' => $plan,
                    'ork_team' => $ork_team
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

    public function getPlans($query, $index, $id_candidate) {
        return $query->whereIn('id_ipr',
            Ipr::where('iprs.id_candidate', '=', $id_candidate)
                ->where('iprs.status', '=', true)
                ->where('iprs.ipr_type', '=', $index)
                ->selectRaw('iprs.id')
                ->get()
        )->sum('amount');
    }

    public function getBalances($query, $index, $id_candidate) {
        return $query->whereIn('id_ipr',
            Ipr::where('iprs.id_candidate', '=', $id_candidate)
                ->where('iprs.status', '=', true)
                ->where('iprs.ipr_type', '=', $index)
                ->selectRaw('iprs.id')
                ->get()
        )->selectRaw('sum(amount) as amount, remarks')->get()[0];
    }
    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getBalanceInfo(Request $request) {
        try {
            $id = $request->id;
            $id_candidate = Ipr::where('id', '=', $id)->first()->id_candidate;
            $balance_remark = Ipr::where('id', '=', $id)->first()->balance_remark;
            $module_result = [];

            $module = Module::where('id', '=', 1)->first();
            $module['service_lists'] = $module->service_lists()->get();
            foreach($module['service_lists'] as $service_list) {
                $service_list['schedule'] = (object)[];
                $service_list['schedule']->trial = $this->getSchedules($service_list->ipr_schedules(), 2, $id_candidate);
                $service_list['schedule']->basic = $this->getSchedules($service_list->ipr_schedules(), 3, $id_candidate);
                $service_list['balance'] = $this->getBalances($service_list->ipr_balances(), 1, $id_candidate);
            }
            $module_result[] = $module;

            $module = Module::where('id', '>', 1)->where('id', '<' ,7)->get();
            foreach($module as $item) {
                $item['service_lists'] = $item->service_lists()
                    ->whereIn('id',
                        IprPlan::leftJoin('iprs', 'ipr_plans.id_ipr', '=', 'iprs.id')
                            ->where('iprs.id_candidate', '=', $id_candidate)
                            ->selectRaw('ipr_plans.id_service')
                            ->get()
                    )->get();
                foreach($item['service_lists'] as $service_list) {
                     $service_list['plan'] = (object)[];
                     $service_list['plan']->trial = $this->getPlans($service_list->ipr_plans(), 2, $id_candidate);
                     $service_list['plan']->basic = $this->getPlans($service_list->ipr_plans(), 3, $id_candidate);
                    $service_list['schedule'] = (object)[];
                    $service_list['schedule']->trial = $this->getSchedules($service_list->ipr_schedules(), 2, $id_candidate);
                    $service_list['schedule']->basic = $this->getSchedules($service_list->ipr_schedules(), 3, $id_candidate);
                    $service_list['balance'] = $this->getBalances($service_list->ipr_balances(), 1, $id_candidate);
                }
                $module_result[] = $item;
            }

            $module = Module::where('id', '=', 7)->first();
            $module['service_lists'] = $module->service_lists()->get();
            foreach($module['service_lists'] as $service_list) {
                $service_list['schedule'] = (object)[];
                $service_list['schedule']->trial = $this->getSchedules($service_list->ipr_schedules(), 2, $id_candidate);
                $service_list['schedule']->basic = $this->getSchedules($service_list->ipr_schedules(), 3, $id_candidate);
                $service_list['balance'] = $this->getBalances($service_list->ipr_balances(), 1, $id_candidate);
            }
            $module_result[] = $module;

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'module' => $module_result,
                    'balance_remark' => $balance_remark
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

    public function updateBalance(Request $request) {
        try {
            $moduleList = $request->moduleList;
            $balance_remark = $request->balance_remark;
            $id = $request->id_ipr;
            Ipr::where('id', '=', $id)->update(['balance_remark' => $balance_remark]);
            IprBalance::where('id_ipr', '=', $id)->delete();
            foreach($moduleList as $module) {
                foreach($module['service_lists'] as $service_list) {
                    IprBalance::create(['id_ipr' => $id, 'id_service' => $service_list['id'], 'amount' => $service_list['balance']['amount'], 'remarks' => $service_list['balance']['remarks']]);
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
                        IprPlan::create([
                            'id_ipr' => $id,
                            'id_service' => $plan['id_service']['id'],
                            'amount' => isset($plan['amount']) ? $plan['amount'] : 0,
                            'start_date' => isset($plan['start_date']) ? $plan['start_date'] : null,
                            'room_number' => isset($plan['room_number']) ? $plan['room_number'] : '',
                            'id_ork_person' => $id_ork_person,
                            'remarks' => isset($plan['remarks']) ? $plan['remarks'] : ''
                        ]);
                    } else {
                        IprPlan::where('id', '=', $plan['id'])->update([
                            'id_ipr' => $id,
                            'id_service' => $plan['id_service'],
                            'amount' => isset($plan['amount']) ? $plan['amount'] : 0,
                            'start_date' => isset($plan['start_date']) ? $plan['start_date'] : null,
                            'room_number' => isset($plan['room_number']) ? $plan['room_number'] : '',
                            'id_ork_person' => $id_ork_person,
                            'remarks' => isset($plan['remarks']) ? $plan['remarks'] : '']);
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

            $count = Ipr::where('id_candidate', '=', $id_candidate)->where('ipr_type', '=', $ipr_type)->where('status', '=', true)->count();
            if ($count != 0) {
                return response()->json([
                    'code' => BAD_REQUEST_CODE,
                    'message' => EXIST_IPR
                ]);
            }
            $ipr = new Ipr();
            $ipr->id_candidate = $id_candidate;
            $ipr->ipr_type = $ipr_type;
            $ipr->number = $number;
            $ipr->schedule_date = $schedule_date;
            $ipr->id_ork_person = $ork_person;
            $ipr->profession = $profession;
            $ipr->status = true;

            $ipr->save();

            if (intval($ipr_type) != 1) {
                $service_list = ServiceList::where('is_required', '=', true)->where('module', '>', 1)->where('module', '<', 7)->where('status', '=', true)->get();
                foreach($service_list as $service) {
                    $item = array('id_ipr' => $ipr->id, 'id_service' => $service->id);
                    IprPlan::create($item);
                }
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
    public function duplicate(Request $request) {
        try {
            $id_ipr = $request->id_ipr;
            $clone_ipr = Ipr::where('id', '=', $id_ipr)->first();
            $ipr = new Ipr();
            $ipr->id_candidate = $clone_ipr->id_candidate;
            $ipr->ipr_type = $clone_ipr->ipr_type;
            $ipr->number = $clone_ipr->number;
            $ipr->schedule_date = $clone_ipr->schedule_date;
            $ipr->id_ork_person = $clone_ipr->id_ork_person;
            $ipr->profession = $clone_ipr->profession;
            $ipr->status = $clone_ipr->status;

            $ipr->save();

            if (intval($clone_ipr->ipr_type) != 1) {
                $ipr_plans = IprPlan::where('id_ipr', '=', $id_ipr)->get();
                foreach($ipr_plans as $item) {
                    $ipr_item = new IprPlan();
                    $ipr_item->id_ipr = $ipr->id;
                    $ipr_item->id_service = $item->id_service;
                    $ipr_item->amount = $item->amount;
                    $ipr_item->start_date = $item->start_date;
                    $ipr_item->room_number = $item->room_number;
                    $ipr_item->id_ork_person = $item->id_ork_person;
                    $ipr_item->remarks = $item->remarks;
                    $ipr_item->save();
                }

            }

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => DUPLICATE_IPR_SUCCSESS,
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
                ->where(DB::raw('CONCAT(candidates.name, " ", candidates.surname)'), 'LIKE', "%{$searchName}%")
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
            Ipr::where('id', '=', $id)->delete();

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
