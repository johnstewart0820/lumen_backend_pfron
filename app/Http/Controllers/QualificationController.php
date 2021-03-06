<?php

namespace App\Http\Controllers;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QualificationController extends Controller
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
            $type = QualificationPointType::all();
            $ambassadors = User::where('status', '=', 1)->get();
            $ambassador_list = [];
            foreach($ambassadors as $ambassador) {
                if (in_array(3, explode(',', $ambassador->id_role))) {
                    array_push($ambassador_list, $ambassador);
                }
            }
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'type' => $type,
                    'ambassadors' => $ambassador_list,
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
            $qualification_point = QualificationPoint::find($id);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'qualification_point' => $qualification_point
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
            $type = $request->type;
            $ambassador = $request->ambassador;

            $qualification_list = QualificationPoint::where('name', '=', $name)->get();
            if (count($qualification_list) > 0) {
                return response()->json([
                    'code' => BAD_REQUEST_CODE,
                    'message' => EXIST_QUALIFICATION_POINT,
                ]);
            }
            $qualification = new QualificationPoint();
            $qualification->name = $name;
            $qualification->type = $type;
            $qualification->ambassador = implode(",", $ambassador);
            $qualification->status = true;
            $qualification->save();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => CREATE_QUALIFICATION_POINT_SUCCESS,
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
            $type = $request->type;
            $ambassador = $request->ambassador;
            $id = $request->id;

            QualificationPoint::find($id)->update(['name' => $name, 'type' => $type, 'ambassador' => implode(",", $ambassador)]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_QUALIFICATION_POINT_SUCCESS,
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
            $columns = ["id", "name", "type", "ambassador"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchName = $request->input('searchName');
            $searchType = $request->input('searchType');
            $searchAmbassador = $request->input('searchAmbassador');
            $query = QualificationPoint::where('name', 'LIKE', "%{$searchName}%")->where('status', '=', true);
            if ($searchId != '') {
                $query->where('id', '=', $searchId);
            }
            if (intval($searchType) != 0) {
                $query->where('type', '=', $searchType);
            }
            if (intval($searchAmbassador) != 0) {
                $query->where('ambassador', 'LIKE', "%{$searchAmbassador}%");
            }
            $qualification_points_count = $query->get();
            $qualification_points = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [ 'qualification_points' => $qualification_points, 'count' => count($qualification_points_count) ]
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
            QualificationPoint::where('id', '=', $id)->update(['status' => false]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => DELETE_QUALIFICATION_POINT_SUCCESS,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
