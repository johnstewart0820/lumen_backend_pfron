<?php

namespace App\Http\Controllers;
use App\Models\OrkTeam;
use App\Models\RehabitationCenter;
use App\Models\Specialization;
use Illuminate\Http\Request;

class OrkTeamsController extends Controller
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
            $rehabitation_center = RehabitationCenter::all();
            $specialization = Specialization::all();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'rehabitation_centers' => $rehabitation_center,
                    'specializations' => $specialization,
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
            $ork_team = OrkTeam::find($id);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
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

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request) {
        try {
            $name = $request->name;
            $rehabitation_center = $request->rehabitation_center;
            $specialization = $request->specialization;
            $is_accepted = $request->is_accepted;
            $date_of_acceptance = $request->date_of_acceptance;

            $ork_team = new OrkTeam();
            $ork_team->name = $name;
            $ork_team->rehabitation_center = implode(",", $rehabitation_center);
            $ork_team->specialization= implode(",", $specialization);
            $ork_team->is_accepted = $is_accepted;
            $ork_team->date_of_acceptance = $date_of_acceptance;
            $ork_team->status = true;
            $ork_team->save();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => CREATE_ORK_TEAM_SUCCESS,
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
            $name = $request->name;
            $rehabitation_center = $request->rehabitation_center;
            $specialization = $request->specialization;
            $is_accepted = $request->is_accepted;
            $date_of_acceptance = $request->date_of_acceptance;
            $id = $request->id;

            OrkTeam::find($id)->update(['name' => $name, 'rehabitation_center' => implode(",", $rehabitation_center), 'specialization' => implode(",", $specialization), 'is_accepted' => $is_accepted, 'date_of_acceptance' => $date_of_acceptance]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_ORK_TEAM_SUCCESS,
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
            $columns = ["id", "name", "rehabitation_center", "specialization"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchName = $request->input('searchName');
            $searchRehabitationCenter = $request->input('searchRehabitationCenter');
            $searchSpecialization = $request->input('searchSpecialization');
            $ork_teams = [];
            $ork_teams_count = 0;
            $query = OrkTeam::where('name', 'LIKE', "%{$searchName}%")->where('status', '=', true);
            if ($searchId != '') {
                $query->where('id', '=', $searchId);
            }
            if (intval($searchRehabitationCenter) != 0) {
                $query->where('rehabitation_center', 'LIKE', "%{$searchRehabitationCenter}%");
            }
            if (intval($searchSpecialization) != 0) {
                $query->where('specialization', 'LIKE', "%{$searchSpecialization}%");
            }
            $ork_teams_count = $query->get();
            $ork_teams = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [ 'ork_teams' => $ork_teams, 'count' => count($ork_teams_count) ]
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
            OrkTeam::where('id', '=', $id)->update(['status' => false]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => DELETE_ORK_TEAM_SUCCESS,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
