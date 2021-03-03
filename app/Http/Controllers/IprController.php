<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use App\Models\CandidateInfo;
use App\Models\Ipr;
use App\Models\IprType;
use App\Models\OrkTeam;
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
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => CREATE_IPR_SUCCESS,
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
