<?php

namespace App\Http\Controllers;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\Specialist;
use App\Models\SpecialtyType;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;

class SpecialistController extends Controller
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
            $specialty = SpecialtyType::all();
            $qualification = QualificationPoint::where('status', '=', 1)->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'specialty' => $specialty,
                    'qualification' => $qualification,
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
            $specialist = Specialist::find($id);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'specialist' => $specialist
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
            $qualification = $request->qualification;
            $specialty = $request->specialty;

            $specialist = new Specialist();
            $specialist->name = $name;
            $specialist->qualification_point = $qualification;
            $specialist->specialty = $specialty;
            $specialist->status = true;
            $specialist->save();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => CREATE_SPECIALIST_POINT_SUCCESS,
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
            $qualification = $request->qualification;
            $specialty = $request->specialty;
            $id = $request->id;

            Specialist::where('id', '=', $id)->update(['name'=>$name, 'qualification_point' => $qualification, 'specialty' => $specialty]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_SPECIALIST_POINT_SUCCESS,
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
            $columns = ["id", "name", "qualification_point", "specialty"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchName = $request->input('searchName');
            $searchQualificationPoint = $request->input('searchQualificationPoint');
            $searchSpecialty = $request->input('searchSpecialty');
            $specialists = [];
            $specialists_count = 0;
            $query = Specialist::where('name', 'LIKE', "%{$searchName}%")->where('status', '=', true);
            if ($searchId != '') {
                $query = $query->where('id', '=', $searchId);
            }
            if (intval($searchQualificationPoint) != 0) {
                $query = $query->where('qualification_point', '=', $searchQualificationPoint);
            }
            if (intval($searchSpecialty) != 0) {
                $query = $query->where('specialty', '=', $searchSpecialty);
            }
            $specialists_count = $query
                ->get();
            $specialists = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => ['specialists' => $specialists, 'count' => count($specialists_count)]
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
            Specialist::where('id', '=', $id)->update(['status' => false]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => DELETE_SPECIALIST_POINT_SUCCESS,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
