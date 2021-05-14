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
use App\Models\ServiceList;
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

    public function getPlans($query, $index, $id_candidate) {
        return $query->whereIn('id_ipr',
            Ipr::where('iprs.id_candidate', '=', $id_candidate)
                ->where('iprs.status', '=', true)
                ->where('iprs.ipr_type', '=', $index)
                ->selectRaw('iprs.id')
                ->get()
        )->sum('amount');
    }

    public function getRecuitment($rehabitation_center, $quater_from, $quater_to, $qualification_point_type) {
        return Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')
            ->leftJoin('qualification_points', 'candidates.qualification_point', '=', 'qualification_points.id')
            ->where('candidate_infos.rehabitation_center', '=', $rehabitation_center)
            ->where('candidates.is_participant', '=', 1)
            ->where('date_rehabitation_center', '>=', $quater_from)
            ->where('date_rehabitation_center', '<=', $quater_to)
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
     * @return  Response
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
                    ->selectRaw('candidates.id, candidate_infos.participant_number')
                    ->orderBy('candidate_infos.participant_number')
                    ->get();
                $candidate_list = $candidate;
            }
            foreach ($candidate_list as $candidate) {
                $module_result = [];
                $module = Module::all();
                foreach($module as $item) {
                    $item['service_lists'] = $item->service_lists()
                        ->leftJoin('units', 'service_lists.unit', '=', 'units.id')
                        ->leftJoin('payments', function($join) use ($quater_to, $quater_from, $rehabitation_center) {
                            $join->on('payments.service', '=', 'service_lists.id')
                                ->where('payments.rehabitation_center', '=', $rehabitation_center)
                                ->leftJoin('flat_rates', function ($q) use ($quater_to, $quater_from) {
                                    $q->on('payments.id', '=', 'flat_rates.payment_id')
                                        ->where('flat_rates.quater_id', '>=', $quater_from)
                                        ->where('flat_rates.quater_id', '<=', $quater_to);
                                });
                        })
                        ->groupBy('service_lists.id')
                        ->orderBy('service_lists.number')
                        ->selectRaw('service_lists.*, units.name as unit_name, payments.value as cost, sum(flat_rates.price) as total_quater_amount')
                        ->get();
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

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getOverDoneData(Request $request) {
        try {
            $rehabitation_center = $request->rehabitation_center;
            $participant = $request->participant;
            $quater_from = $request->quater_from;
            $quater_to = $request->quater_to;
            $candidate_list = [];

            if ($participant != 0 ) {
                $candidate = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')
                    ->where('candidates.id', '=', $participant)
                    ->selectRaw('candidates.id, candidate_infos.participant_number')->first();
                $candidate_list[] = $candidate;
                $rehabitation_center = CandidateInfo::where('id_candidate', '=', $participant)->first()->rehabitation_center;
            } else {
                $candidate = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')
                    ->where('candidate_infos.rehabitation_center', '=', $rehabitation_center)
                    ->selectRaw('candidates.id, candidate_infos.participant_number')
                    ->orderBy('candidate_infos.participant_number')
                    ->get();
                $candidate_list = $candidate;
            }

            $quater_from_order = RehabitationCenterQuater::where('center_id', '=', $rehabitation_center)->where('id', '<=', $quater_from)->count();
            $quater_to_order = RehabitationCenterQuater::where('center_id', '=', $rehabitation_center)->where('id', '<=', $quater_to)->count();

            foreach ($candidate_list as $candidate) {
                $candidate['service_lists'] = ServiceList::leftJoin('units', 'service_lists.unit', '=', 'units.id')
                    ->leftJoin('payments', function($join) use ($rehabitation_center) {
                        $join->on('payments.service', '=', 'service_lists.id')
                            ->where('payments.rehabitation_center', '=', $rehabitation_center);
                    })

                    ->selectRaw('service_lists.*, units.name as unit_name, payments.value as cost')
                    ->orderBy('service_lists.number')
                    ->get();
                foreach($candidate['service_lists'] as $service_list) {
                    $service_list['plan'] = (object)[];
                    $service_list['plan']->trial = $this->getPlans($service_list->ipr_plans(), 2, $candidate->id);
                    $service_list['plan']->basic = $this->getPlans($service_list->ipr_plans(), 3, $candidate->id);

                    $service_list['schedule'] = (object)[];
                    $service_list['schedule']->trial = [];
                    $service_list['schedule']->basic = [];

                    for ($i = $quater_from; $i <= $quater_to; $i ++) {
                        $quater_from_obj = RehabitationCenterQuater::where('id', '=', $i)->first();
                        $quater_to_obj = RehabitationCenterQuater::where('id', '=', $i)->first();
                        $quater_from_date = $quater_from_obj->start_date;
                        $quater_to_date = $quater_to_obj->end_date;
                        $service_list['schedule']->trial[] = $this->getSchedules($service_list->ipr_schedules(), 2, $candidate->id, $quater_from_date, $quater_to_date);
                        $service_list['schedule']->basic[] = $this->getSchedules($service_list->ipr_schedules(), 3, $candidate->id, $quater_from_date, $quater_to_date);
                    }
                }
            }
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'candidate' => $candidate_list,
                    'start_order' => $quater_from_order,
                    'end_order' => $quater_to_order,
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

    public function getParticipantsData($rehabitation_center, $quater_from_date, $quater_to_date) {
        $query = [];
        $title = [
            'Liczba uczestników ogółem, w tym:',
            'tryb: stacjonarny',
            'tryb: niestacjonarny',
            'płeć: kobiety',
            'płeć: mężczyźni',
            'wykształcenie: niepełne podstawowe (ISCED 0)',
            'wykształcenie: podstawowe (ISCED 1)',
            'wykształcenie: gimnazjalne (ISCED 2)',
            'wykształcenie: zasadnicze zawodowe (ISCED 3)',
            'wykształcenie: średnie zawodowe (ISCED 3)',
            'wykształcenie: licealne (ISCED 3)',
            'wykształcenie: pomaturalne (ISCED 4)',
            'wykształcenie: wyższe zawodowe (ISCED 5-6)',
            'wykształcenie: wyższe magisterskie (ISCED 7)',
            'wykształcenie: wyższy stopień lub tytuł naukowy (ISCED 8)',
            'wiek: do 25 lat',
            'wiek: 26-35 lat',
            'wiek: 36-45 lat',
            'wiek: 46-55 lat',
            'wiek: 56 lat i powyżej',
            'zakwalifikowany  w związku z chorobą zawodową',
            'zakwalifikowany  w związku z wypadkiem przy pracy',
            'zakwalifikowany z powodu  ogólnego stanu zdrowia',
            'instytucja kierująca: ZUS',
            'instytucja kierująca: PFRON',
            'instytucja kierująca: MSWiA i MON',
            'instytucja kierująca:  zespoły ds. orzekania o niepełnosprawności',
            'korzystających ze świadczeń dodatkowych (np. opieki nad dziećmi)',
            'Liczba opracowanych IPR',
            'Liczba realizowanych IPR',
            'Liczba zakończonych IPR',
            'Liczba uczestników, którzy zrezygnowali',
            'Liczba uczestników, którzy zostali usunięci z  listy uczestników',
            'Powody rezygnacji uczestników (zbiorczo - jeśli dotyczy)',
            'Średni czas pobytu  uczestników w ORK w dniach, w tym:',
            'pobyt stacjonarny',
            'pobyt niestacjonarny',
        ];
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('type_to_stay', '=', 1);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('type_to_stay', '=', 2);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('gender', '=', 1);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('gender', '=', 2);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('education', '=', 1);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('education', '=', 6);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('education', '=', 2);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('education', '=', 7);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('education', '=', 3);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('education', '=', 8);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('education', '=', 4);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('education', '=', 9);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('education', '=', 5);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('education', '=', 10);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('age', '<=', 25);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('age', '>', 25)->where('age', '<=', 35);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('age', '>', 35)->where('age', '<=', 45);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('age', '>', 45)->where('age', '<=', 55);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('age', '>', 55);
        $query[] = null;
        $query[] = null;
        $query[] = null;
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('qualification_point', '=', 1);
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('qualification_point', '=', 2);
        $query[] = null;
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)->where('qualification_point', '=', 3);
        $query[] = null;
        $query[] = null;
        $query[] = null;
        $query[] = null;
        $query[] = Candidate::leftJoin('candidate_infos', 'candidates.id', '=', 'candidate_infos.id_candidate')->where('rehabitation_center', '=', $rehabitation_center)->where('is_participant', '=', true)
            ->where(function ($q) {
                $q->where('participant_status_type', '=', 4)->orWhere('participant_status_type', '=', 5)->orWhere('participant_status_type', '=', 6);
            });
        $query[] = null;
        $query[] = null;
        $query[] = null;
        $query[] = null;
        $query[] = null;
        for($i = 0; $i < count($query); $i ++) {
            $org_query = $query[$i];
            $amount_query = null;
            $used_query = null;
            $ascending_query = null;
            if ($org_query != null) {
                $amount_query = clone $org_query;
                $used_query = clone $org_query;
                $ascending_query = clone $org_query;
            }
            if ($amount_query == null)
                $participants[] = ['title' => $title[$i], 'amount' => 0, 'used' => 0, 'ascending' => 0];
            else
                $participants[] = [
                    'title' => $title[$i],
                    'amount' => $amount_query->where('date_rehabitation_center', '>=', $quater_from_date)->where('date_rehabitation_center', '<=', $quater_to_date)->count(),
                    'used' => $used_query->where('date_rehabitation_center', '>=', $quater_from_date)->where('date_rehabitation_center', '<=', $quater_to_date)->count(),
                    'ascending' => $ascending_query->where('date_rehabitation_center', '<=', $quater_to_date)->count(),
                ];
        }
        return $participants;
    }

    public function getTableData($rehabitation_center, $quater_from_date, $quater_to_date) {
        $module_list =
            array(
                array(
                    'title' => 'Część 3. Moduł zawodowy',
                    'table1' => array(
                        array(
                            'title' => '1. Działania aktywizujące',
                            'service_list' => array(
                                array(
                                    'id' => 12,
                                    'title' => 'Liczba osób, którym udzielono doradztwa zawodowego  (osoby niepowtarzające się)',
                                ),
                                array(
                                    'id' => 14,
                                    'title' => 'Liczba uczestników szkoleń  wyrównujących deficyty (osoby niepowtarzające się)',
                                ),
                                array(
                                    'id' => 15,
                                    'title' => 'Liczba uczestników  szkoleń ICT',
                                )
                            )
                        ),
                        array(
                            'title' => '2. Przekwalifikowanie zawodowe',
                            'service_list' => array(
                                array(
                                    'id' => 16,
                                    'title' => 'Liczba uczestników szkoleń w ORK (osoby niepowtarzające się)',
                                ),
                                array(
                                    'id' => 17,
                                    'title' => 'Liczba uczestników szkoleń poza ORK (osoby niepowtarzające się)',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba osób, które zakończyły przekwalifikowanie się z pozytywnym wynikiem (tj. zdały egzamin)',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba osób, które zakończyły przekwalifikowanie się z negatywnym wynikiem (tj. nie zdały egzaminu)',
                                )

                            )
                        )
                    ),
                    'table2' => array(
                        array(
                            'title' => '1. Działania aktywizujące',
                            'service_list' => array(
                                array(
                                    'id' => 12,
                                    'type' => 'hours',
                                    'title' => 'Liczba godzin doradztwa zawodowego',
                                ),
                                array(
                                    'id' => 12,
                                    'type' => 'avg',
                                    'title' => 'Średnia liczba godzin doradztwa zawodowego w przeliczeniu na 1 uczestnika',
                                ),
                                array(
                                    'id' => 14,
                                    'type' => 'hours',
                                    'title' => 'Liczba zrealizowanych szkoleń wyrównujących deficyty',
                                ),
                                array(
                                    'id' => 14,
                                    'type' => 'hours',
                                    'title' => 'Liczba godzin zrealizowanych szkoleń wyrównujących deficyty',
                                ),
                                array(
                                    'id' => 14,
                                    'type' => 'avg',
                                    'title' => 'Średnia liczba godzin zrealizowanych szkoleń wyrównujących deficyty w przeliczeniu na  1 uczestnika',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba zrealizowanych szkoleń w ORK',
                                ),
                                array(
                                    'id' => 15,
                                    'type' => 'hours',
                                    'title' => 'Liczba godzin zrealizowanych szkoleń ICT',
                                ),
                                array(
                                    'id' => 15,
                                    'type' => 'avg',
                                    'title' => 'Średnia liczba godzin zrealizowanych szkoleń ICT w przeliczeniu na 1 uczestnika',
                                ),
                            )
                        ),
                        array(
                            'title' => '2. Przekwalifikowanie zawodowe',
                            'service_list' => array(
                                array(
                                    'id' => 16,
                                    'type' => 'hours',
                                    'title' => 'Liczba zrealizowanych szkoleń w  ORK',
                                ),
                                array(
                                    'id' => 16,
                                    'type' => 'hours',
                                    'title' => 'Liczba godzin zrealizowanych szkoleń w  ORK',
                                ),
                                array(
                                    'id' => 16,
                                    'type' => 'avg',
                                    'title' => 'Średnia liczba godzin zrealizowanych szkoleń w ORK w przeliczeniu na 1 uczestnika',
                                ),
                                array(
                                    'id' => 17,
                                    'type' => 'hours',
                                    'title' => 'Liczba zrealizowanych szkoleń poza ORK',
                                ),
                                array(
                                    'id' => 17,
                                    'type' => 'hours',
                                    'title' => 'Liczba godzin zrealizowanych szkoleń poza ORK',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Średnia liczba zrealizowanych szkoleń   poza ORK w przeliczeniu na 1 uczestnika',
                                )
                            )
                        ),
                        array(
                            'title' => '3. Pośrednictwo pracy',
                            'service_list' => array(
                                array(
                                    'id' => null,
                                    'title' => 'Liczba pracodawców, z którymi nawiązano kontakt',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba pozyskanych ofert pracy',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Średnia liczba pozyskanych ofert pracy w przeliczeniu na 1 uczestnika',
                                ),
                            )
                        )
                    )
                ),

                array(
                    'title' => 'Część 4. Moduł psychospołeczny',
                    'table1' => array(
                        array(
                            'title' => '1. Oddziaływanie skierowane do uczestników',
                            'service_list' => array(
                                array(
                                    'id' => 22,
                                    'title' => 'Liczba osób biorących udział w zajęciach w module psychospołecznym  w kontakcie indywidualnym  (osoby niepowtarzające się)',
                                ),
                                array(
                                    'id' => 23,
                                    'title' => 'Liczba osób biorących udział w zajęciach w module psychospołecznym w kontakcie grupowym (osoby niepowtarzające się)',
                                ),
                            )
                        ),
                        array(
                            'title' => '2. Oddziaływanie skierowane do personelu',
                            'service_list' => array(
                                array(
                                    'id' => null,
                                    'title' => 'Liczba osób biorących udział w działaniach w kontakcie indywidualnym (osoby niepowtarzające się)',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba osób biorących udział w działaniach w kontakcie grupowym (osoby niepowtarzające się)',
                                ),
                            )
                        ),
                        array(
                            'title' => '3. Oddziaływanie skierowane do środowiska',
                            'service_list' => array(
                                array(
                                    'id' => 24,
                                    'title' => 'Liczba osób biorących udział w działaniach  w kontakcie indywidualnym (osoby niepowtarzające się)',
                                ),
                                array(
                                    'id' => 25,
                                    'title' => 'Liczba osób biorących udział w działaniach w kontakcie grupowym (osoby niepowtarzające się)',
                                ),
                            )
                        ),
                        array(
                            'title' => '4. Konsultacje specjalistyczne',
                            'service_list' => array(
                                array(
                                    'id' => null,
                                    'title' => 'Liczba osób biorących udział w  konsultacjach zewnętrznych',
                                ),
                            )
                        )
                    ),
                    'table2' => array(
                        array(
                            'title' => '1. Oddziaływanie skierowane do uczestników',
                            'service_list' => array(
                                array(
                                    'id' => 22,
                                    'type' => 'hours',
                                    'title' => 'Liczba godzin zajęć w module psychospołecznym w kontakcie indywidualnym',
                                ),
                                array(
                                    'id' => 22,
                                    'type' => 'avg',
                                    'title' => 'Średnia liczba godzin zajęć w module psychospołecznym w kontakcie indywidualnym w przeliczeniu na 1 uczestnika',
                                ),
                                array(
                                    'id' => 23,
                                    'type' => 'hours',
                                    'title' => 'Liczba godzin zajęć rehabilitacji w module psychospołecznym w kontakcie grupowym (osoby niepowtarzające się)',
                                ),
                                array(
                                    'id' => 23,
                                    'type' => 'avg',
                                    'title' => 'Średnia liczba godzin  zajęć  w module psychospołecznym w kontakcie grupowym (osoby niepowtarzające się) w przeliczeniu na 1 uczestnika'
                                )
                            )
                        ),
                        array(
                            'title' => '2. Oddziaływanie skierowane do personelu',
                            'service_list' => array(
                                array(
                                    'id' => null,
                                    'title' => 'Liczba godzin  działań w kontakcie indywidualnym (osoby niepowtarzające się)',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Średnia liczba godzin  działań w kontakcie indywidualnym (osoby niepowtarzające się) w przeliczeniu na 1 uczestnika',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba godzin działań w kontakcie grupowym (osoby niepowtarzające się)',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Średnia liczba godzin działań w kontakcie grupowym (osoby niepowtarzające się) w przeliczeniu na 1 uczestnika',
                                )

                            )
                        ),
                        array(
                            'title' => '3. Oddziaływanie skierowane do środowiska',
                            'service_list' => array(
                                array(
                                    'id' => 24,
                                    'type' => 'hours',
                                    'title' => 'Liczba godzin działań  w module psychospołecznym w kontakcie indywidualnym (osoby niepowtarzające się)',
                                ),
                                array(
                                    'id' => 24,
                                    'type' => 'avg',
                                    'title' => 'Średnia liczba godzin działań w module psychospołecznym  w kontakcie indywidualnym (osoby niepowtarzające się) w  przeliczeniu na 1 uczestnika',
                                ),
                                array(
                                    'id' => 25,
                                    'type' => 'hours',
                                    'title' => 'Liczba godzin działań w module psychospołecznym w kontakcie grupowym (osoby niepowtarzające się)',
                                ),
                                array(
                                    'id' => 25,
                                    'type' => 'avg',
                                    'title' => 'Średnia liczba godzin działań w module psychospołecznym w kontakcie grupowym (osoby niepowtarzające się) w przeliczeniu na 1 uczestnika',
                                ),
                            )
                        ),
                        array(
                            'title' => '4. Konsultacje specjalistyczne',
                            'service_list' => array(
                                array(
                                    'id' => null,
                                    'title' => 'Liczba godzin zrealizowanych konsultacji zewnętrznych w module psychospołecznym ',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Średnia liczba godzin zrealizowanych konsultacji zewnętrznych w module psychospołecznym w przeliczeniu na 1 uczestnika',
                                ),
                            )
                        )
                    )
                ),

                array(
                    'title' => 'Część 5. Moduł medyczny',
                    'table1' => array(
                        array(
                            'title' => '1. Procedury medyczne:',
                            'service_list' => array(
                                array(
                                    'id' => null,
                                    'title' => 'Liczba osób uczestniczących w procedurze: kinezyterapia',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba osób uczestniczących w procedurze: fizykoterapia',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba osób uczestniczących w procedurze: masaż leczniczy',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba osób uczestniczących w procedurze: terapia zajęciowa',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba osób uczestniczących w procedurze: terapia logopedyczna',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba osób uczestniczących w procedurze: pozostałe (łącznie)',
                                ),
                            )
                        ),
                        array(
                            'title' => '2. Działania edukacyjne',
                            'service_list' => array(
                                array(
                                    'id' => 27,
                                    'title' => 'Liczba osób, którym udzielono  instruktażu (prozdrowotny, w zakresie ergonomii, ćwiczeń do wykonania w domu)',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba osób biorących udział w pozostałych działaniach (łącznie)',
                                ),
                            )
                        ),
                    ),
                    'table2' => array(
                        array(
                            'title' => '1. Procedury medyczne',
                            'service_list' => array(
                                array(
                                    'id' => null,
                                    'title' => 'Łączna liczba zrealizowanych procedur: kinezyterapia',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Łączna liczba godzin zrealizowanych procedur: kinezyterapia',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Średnia liczba godzin zrealizowanych procedur w przeliczeniu na 1 uczestnika: kinezyterapia',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Łączna liczba zrealizowanych procedur: fizykoterapia',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Łączna liczba godzin zrealizowanych procedur: fizykoterapia',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Średnia liczba godzin zrealizowanych procedur w przeliczeniu na 1 uczestnika: fizykoterapia',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Łączna liczba zrealizowanych procedur: masaż leczniczy',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Łączna liczba godzin zrealizowanych procedur: masaż leczniczy',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Średnia liczba godzin zrealizowanych procedur w przeliczeniu na 1 uczestnika: masaż leczniczy',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Łączna liczba zrealizowanych procedur: terapia zajęciowa',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Łączna liczba godzin zrealizowanych procedur: terapia zajęciowa',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Średnia liczba godzin zrealizowanych procedur w przeliczeniu na 1 uczestnika: terapia zajęciowa',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Łączna liczba zrealizowanych procedur: terapia logopedyczna',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Łączna liczba godzin zrealizowanych procedur: terapia logopedyczna',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Średnia liczba godzin zrealizowanych procedur w przeliczeniu na 1 uczestnika: terapia logopedyczna',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Łączna liczba zrealizowanych procedur: inne (łącznie)',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Łączna liczba godzin zrealizowanych procedur: inne (łącznie)',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Średnia liczba godzin zrealizowanych procedur w przeliczeniu na 1 uczestnika: inne (łącznie)',
                                ),
                            )
                        ),
                        array(
                            'title' => '2. Działania edukacyjne',
                            'service_list' => array(
                                array(
                                    'id' => 27,
                                    'type' => 'amount',
                                    'title' => 'Liczba zrealizowanych instruktaży (prozdrowotnych, w zakresie ergonomii, ćwiczeń do wykonania w domu)',
                                ),
                                array(
                                    'id' => 27,
                                    'type' => 'hours',
                                    'title' => 'Liczba godzin zrealizowanych instruktaży (prozdrowotnych, w zakresie ergonomii, ćwiczeń do wykonania w domu)',
                                ),
                                array(
                                    'id' => 27,
                                    'type' => 'avg',
                                    'title' => 'Średnia liczba zrealizowanych instruktaży (prozdrowotnych, w zakresie ergonomii, ćwiczeń do wykonania w domu) w przeliczeniu na 1 uczestnika',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba przekazanych pakietów materiałów edukacyjnych',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba pozostałych  działań (łącznie)',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Liczba zrealizowanych godzin  pozostałych działań (łącznie)',
                                ),
                                array(
                                    'id' => null,
                                    'title' => 'Średnia zrealizowanych liczba godzin  pozostałych  działań (łącznie) w przeliczeniu na 1 uczestnika',
                                ),
                            )
                        ),
                    )
                ),
            );
        foreach($module_list as &$module) {
            $table1 = &$module['table1'];
            $table2 = &$module['table2'];
            foreach($table1 as &$row) {
                $service_list = &$row['service_list'];
                foreach($service_list as &$service) {
                    if ($service['id']) {
                        $service['started'] = 0;
                        $service['continue'] = 0;
                        $service['ended'] = 0;
                        $service['asc_started'] = 0;
                        $service['asc_continue'] = 0;
                        $service['asc_ended'] = 0;
                        $service['plan'] = Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                            ->leftJoin('ipr_plans', 'iprs.id', '=', 'ipr_plans.id_ipr')
                            ->where('id_service', '=', $service['id'])
                            ->where('rehabitation_center', '=', $rehabitation_center)
                            ->where('schedule_date', '>=', $quater_from_date)
                            ->where('schedule_date', '<=', $quater_to_date)
                            ->groupBy('iprs.id_candidate')
                            ->get()
                            ->count();
                        $service['asc_plan'] = Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                            ->leftJoin('ipr_plans', 'iprs.id', '=', 'ipr_plans.id_ipr')
                            ->where('id_service', '=', $service['id'])
                            ->where('rehabitation_center', '=', $rehabitation_center)
                            ->where('schedule_date', '<=', $quater_to_date)
                            ->groupBy('iprs.id_candidate')
                            ->get()
                            ->count();
                        $plan_arr = Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                            ->leftJoin('ipr_plans', 'iprs.id', '=', 'ipr_plans.id_ipr')
                            ->where('ipr_plans.id_service', '=', $service['id'])
                            ->where('rehabitation_center', '=', $rehabitation_center)
                            ->where('schedule_date', '>=', $quater_from_date)
                            ->where('schedule_date', '<=', $quater_to_date)
                            ->groupBy('iprs.id_candidate')
                            ->selectRaw('iprs.id_candidate, amount as plan')->get();
                        $schedule_arr = Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                            ->leftJoin('ipr_schedules', 'iprs.id', '=', 'ipr_schedules.id_ipr')
                            ->where('ipr_schedules.id_service', '=', $service['id'])
                            ->where('rehabitation_center', '=', $rehabitation_center)
                            ->where('schedule_date', '>=', $quater_from_date)
                            ->where('schedule_date', '<=', $quater_to_date)
                            ->groupBy('iprs.id_candidate')
                            ->selectRaw('iprs.id_candidate, total_amount as schedule')->get();
                        foreach($plan_arr as $item) {
                            foreach($schedule_arr as $schedule_item) {
                                if ($item->id_candidate == $schedule_item->id_candidate) {
                                    if ($item->plan >= $schedule_item->schedule) {
                                       $service['continue']++;
                                    } else {
                                        $service['ended']++;
                                    }
                                }
                            }
                        }
                        $service['started'] = $service['plan'] - $service['continue'] - $service['ended'];

                        $plan_asc_arr = Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                            ->leftJoin('ipr_plans', 'iprs.id', '=', 'ipr_plans.id_ipr')
                            ->where('ipr_plans.id_service', '=', $service['id'])
                            ->where('rehabitation_center', '=', $rehabitation_center)
                            ->where('schedule_date', '<=', $quater_to_date)
                            ->groupBy('iprs.id_candidate')
                            ->selectRaw('iprs.id_candidate, amount as plan')->get();
                        $schedule_asc_arr = Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                            ->leftJoin('ipr_schedules', 'iprs.id', '=', 'ipr_schedules.id_ipr')
                            ->where('ipr_schedules.id_service', '=', $service['id'])
                            ->where('rehabitation_center', '=', $rehabitation_center)
                            ->where('schedule_date', '<=', $quater_to_date)
                            ->groupBy('iprs.id_candidate')
                            ->selectRaw('iprs.id_candidate, total_amount as schedule')->get();
                        foreach($plan_asc_arr as $item) {
                            foreach($schedule_asc_arr as $schedule_item) {
                                if ($item->id_candidate == $schedule_item->id_candidate) {
                                    if ($item->plan >= $schedule_item->schedule) {
                                        $service['asc_continue'] ++;
                                    } else {
                                        $service['asc_ended'] ++;
                                    }
                                }
                            }
                        }

                        $service['asc_started'] = $service['asc_plan'] - $service['asc_continue'] - $service['asc_ended'];
                    }
                    else {
                        $service['plan'] = '';
                        $service['started'] = '';
                        $service['continue'] = '';
                        $service['ended'] = '';
                        $service['asc_started'] = '';
                        $service['asc_continue'] = '';
                        $service['asc_ended'] = '';
                    }
                }
            }

            foreach($table2 as &$row) {
                $service_list = &$row['service_list'];
                foreach($service_list as &$service) {
                    if (!$service['id']) {
                        $service['plan'] = 0;
                        $service['week'] = 0;
                        $service['asc'] = 0;
                    } else {
                        if ($service['type'] === 'hours') {
                            $service['plan'] = round(Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                                ->leftJoin('ipr_plans', 'iprs.id', '=', 'ipr_plans.id_ipr')
                                ->where('ipr_plans.id_service', '=', $service['id'])
                                ->where('rehabitation_center', '=', $rehabitation_center)
                                ->where('schedule_date', '<=', $quater_to_date)
                                ->where('schedule_date', '>=', $quater_from_date)
                                ->sum('amount'),2);
                            $service['week'] = round(Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                                ->leftJoin('ipr_schedules', 'iprs.id', '=', 'ipr_schedules.id_ipr')
                                ->where('ipr_schedules.id_service', '=', $service['id'])
                                ->where('rehabitation_center', '=', $rehabitation_center)
                                ->where('schedule_date', '<=', $quater_to_date)
                                ->where('schedule_date', '>=', $quater_from_date)
                                ->sum('total_amount'), 2);
                            $service['asc'] = round(Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                                ->leftJoin('ipr_schedules', 'iprs.id', '=', 'ipr_schedules.id_ipr')
                                ->where('ipr_schedules.id_service', '=', $service['id'])
                                ->where('rehabitation_center', '=', $rehabitation_center)
                                ->where('schedule_date', '<=', $quater_to_date)
                                ->sum('total_amount'), 2);
                        } else {
                            $participant_count = Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                                ->leftJoin('ipr_plans', 'iprs.id', '=', 'ipr_plans.id_ipr')
                                ->where('id_service', '=', $service['id'])
                                ->where('rehabitation_center', '=', $rehabitation_center)
                                ->where('schedule_date', '>=', $quater_from_date)
                                ->where('schedule_date', '<=', $quater_to_date)
                                ->groupBy('iprs.id_candidate')
                                ->get()
                                ->count();
                            if ($participant_count == 0)
                                $participant_count = 1;
                            $service['plan'] = round(Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                                ->leftJoin('ipr_plans', 'iprs.id', '=', 'ipr_plans.id_ipr')
                                ->where('ipr_plans.id_service', '=', $service['id'])
                                ->where('rehabitation_center', '=', $rehabitation_center)
                                ->where('schedule_date', '<=', $quater_to_date)
                                ->where('schedule_date', '>=', $quater_from_date)
                                ->sum('amount') / $participant_count, 2);
                            $service['week'] = round(Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                                ->leftJoin('ipr_schedules', 'iprs.id', '=', 'ipr_schedules.id_ipr')
                                ->where('ipr_schedules.id_service', '=', $service['id'])
                                ->where('rehabitation_center', '=', $rehabitation_center)
                                ->where('schedule_date', '<=', $quater_to_date)
                                ->where('schedule_date', '>=', $quater_from_date)
                                ->sum('total_amount') / $participant_count, 2);
                            $service['asc'] = round(Ipr::leftJoin('candidate_infos', 'iprs.id_candidate', '=', 'candidate_infos.id_candidate')
                                ->leftJoin('ipr_schedules', 'iprs.id', '=', 'ipr_schedules.id_ipr')
                                ->where('ipr_schedules.id_service', '=', $service['id'])
                                ->where('rehabitation_center', '=', $rehabitation_center)
                                ->where('schedule_date', '<=', $quater_to_date)
                                ->sum('total_amount') / $participant_count, 2);
                        }
                    }
                }
            }
        }
        return $module_list;
    }

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function getRehabitationData(Request $request) {
        try {
            $rehabitation_center = $request->rehabitation_center;
            $quater_from = $request->quater_from;
            $quater_to = $request->quater_to;

            $quater_from_order = RehabitationCenterQuater::where('center_id', '=', $rehabitation_center)->where('id', '<=', $quater_from)->count();
            $quater_to_order = RehabitationCenterQuater::where('center_id', '=', $rehabitation_center)->where('id', '<=', $quater_to)->count();

            $rehabitation_center_obj = RehabitationCenter::where('id', '=', $rehabitation_center)->first();
            $rehabitation_partners = $rehabitation_center_obj->partners()->get();

            $quater_from_obj = RehabitationCenterQuater::where('id', '=', $quater_from)->first();
            $quater_to_obj = RehabitationCenterQuater::where('id', '=', $quater_to)->first();
            $quater_from_date = $quater_from_obj->start_date;
            $quater_to_date = $quater_to_obj->end_date;

            $participants = $this->getParticipantsData($rehabitation_center, $quater_from_date, $quater_to_date);
            $table_data = $this->getTableData($rehabitation_center, $quater_from_date, $quater_to_date);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'rehabitation_center' => $rehabitation_center_obj,
                    'rehabitation_partners' => $rehabitation_partners,
                    'participants' => $participants,
                    'table_data' => $table_data
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
