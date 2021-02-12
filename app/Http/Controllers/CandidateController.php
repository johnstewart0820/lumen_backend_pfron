<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use App\Models\Payment;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\RehabitationCenter;
use App\Models\ServiceList;
use App\Models\Stage;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
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
            $stage = Stage::all();
            $qualification_point = QualificationPoint::all();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'stage' => $stage,
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
    public function get(Request $request) {
        try {
            $id = $request->input('id');
            $candidate = Candidate::find($id);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'candidate' => $candidate
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
            $surname = $request->surname;
            $person_id = $request->person_id;
            $date_of_birth = $request->date_of_birth;
            $place_of_birth = $request->place_of_birth;
            $street = $request->street;
            $house_number = $request->house_number;
            $apartment_number = $request->apartment_number;
            $post_code = $request->post_code;
            $post_office = $request->post_office;
            $city = $request->city;
            $stage = $request->stage;
            $comment = $request->comment;

            $payment = new Candidate();
            $payment->name = $name;
            $payment->surname = $surname;
            $payment->person_id = $person_id;
            $payment->date_of_birth = $date_of_birth;
            $payment->place_of_birth = $place_of_birth;
            $payment->street = $street;
            $payment->house_number = $house_number;
            $payment->apartment_number = $apartment_number;
            $payment->post_code = $post_code;
            $payment->post_office = $post_office;
            $payment->city = $city;
            $payment->stage = $stage;
            $payment->comment = $comment;
            $payment->status = true;
            $payment->save();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => CREATE_CANDIDATE_SUCCESS,
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
            $surname = $request->surname;
            $person_id = $request->person_id;
            $date_of_birth = $request->date_of_birth;
            $place_of_birth = $request->place_of_birth;
            $street = $request->street;
            $house_number = $request->house_number;
            $apartment_number = $request->apartment_number;
            $post_code = $request->post_code;
            $post_office = $request->post_office;
            $city = $request->city;
            $stage = $request->stage;
            $comment = $request->comment;
            $id = $request->id;

            Candidate::find($id)->update([
                'name' => $name,
                'surname' => $surname,
                'person_id' => $person_id,
                'date_of_birth' => $date_of_birth,
                'place_of_birth' =>  $place_of_birth,
                'street' => $street,
                'house_number' => $house_number,
                'apartment_number' => $apartment_number,
                'post_code' => $post_code,
                'post_office' => $post_office,
                'city' => $city,
                'stage' => $stage,
                'comment' => $comment,
            ]);
            Candidate::find($id)->touch();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => UPDATE_CANDIDATE_SUCCESS,
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
            $columns = ["id", "name", "surname", "qualification_point", "stage", "updated_at"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchName = $request->input('searchName');
            $searchSurname = $request->input('searchSurname');
            $searchQualificationPoint = $request->input('searchQualificationPoint');
            $searchStage = $request->input('searchStage');
            $searchDateModified = $request->input('searchDateModified');

            $candidates = [];
            $candidates_count = [];
            $query = Candidate::where('name', 'LIKE', "%{$searchName}%")->where('surname', 'LIKE', "%{$searchSurname}%")->where('status', '=', true);
            if ($searchId != '') {
                $query->where('id', '=', $searchId);
            }
            if (intval($searchQualificationPoint) != 0) {
                $query->where('qualification_point', '=', $searchQualificationPoint);
            }
            if (intval($searchStage) != 0) {
                $query->where('stage', '=', $searchStage);
            }
            if ($searchDateModified['from'] != '') {
                $query->where('updated_at', '>', $searchDateModified['from']);
            }
            if ($searchDateModified['to'] != '') {
                $query->where('updated_at', '<', $searchDateModified['to']);
            }
            $candidates_count = $query->get();

            $candidates = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [ 'candidates' => $candidates, 'count' => count($candidates_count) ]
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
            Candidate::where('id', '=', $id)->update(['status' => false]);

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => DELETE_CANDIDATE_SUCCESS,
            ]);
        } catch(Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

}
