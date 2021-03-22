<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use App\Models\CandidateComment;
use App\Models\CandidateInfo;
use App\Models\Community;
use App\Models\County;
use App\Models\Educations;
use App\Models\EmployedType;
use App\Models\Payment;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\RehabitationCenter;
use App\Models\ServiceList;
use App\Models\Specialist;
use App\Models\Stage;
use App\Models\Status;
use App\Models\Voivodeship;
use Carbon\Carbon;
use Database\Seeders\EmployedTypeSeeder;
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
            $voivodeship = Voivodeship::all();
            $community = Community::selectRaw('Concat(name, " (" , type, ")") as name, id, county_id')->get();
            $education = Educations::all();
            $county = County::all();
            $employedTypeList = EmployedType::all();
            $tempQualificationArr = QualificationPoint::where('status', '=', 1)->get();
            $qualificationPoint = [];
            if (Auth::user()->id_role == 3) {
                foreach($tempQualificationArr as $item) {
                    $arr = explode(',', $item->ambassador);
                    if (in_array(Auth::user()->id, $arr)) {
                        $qualificationPoint[] = $item;
                    }
                }
            } else {
                $qualificationPoint = $tempQualificationArr;
            }
            $rehabitationCenter = RehabitationCenter::all();
            $status = Status::all();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'stage' => $stage,
                    'voivodeship' => $voivodeship,
                    'community' => $community,
                    'county' => $county,
                    'education' => $education,
                    'status' => $status,
                    'employed_type' => $employedTypeList,
                    'qualification_point' => $qualificationPoint,
                    'rehabitation_center' => $rehabitationCenter,
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
    public function getHistoryInfo(Request $request) {
        try {
            $users = User::all();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'user' => $users
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
    public function getMarker(Request $request) {
        try {
            $id = $request->input('qualification_point');
            $doctor = Specialist::where('qualification_point', '=', $id)->where('specialty', '>', 1)->get();
            $psycology = Specialist::where('qualification_point', '=', $id)->where('specialty', '=', 1)->get();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'doctor' => $doctor,
                    'psycology' => $psycology
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
    public function getCandidateInfo(Request $request) {
        try {
            $id = $request->input('id');
            $candidateInfo = CandidateInfo::where('id_candidate', '=', $id)->first();
            $candidate = Candidate::find($id);
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'candidate_info' => $candidateInfo,
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
    public function updateStep1(Request $request) {
        try {
            $id = $request->input('id');
            CandidateInfo::where('id_candidate', '=', $id)->update([
                'gender' => $request->gender,
            ]);
            Candidate::find($id)->update([
                'qualification_point' => $request->qualification_point,
                'stage' => $request->stage,
                'id_status' => $request->status,
            ]);

            $candidateComment = new CandidateComment();
            $candidateComment->description = CANDIDATE_UPDATE_1;
            $candidateComment->created_by = Auth::user()->id;
            $candidateComment->id_candidate = $id;
            $candidateComment->save();

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

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateStep2(Request $request) {
        try {
            $id = $request->input('id');
            CandidateInfo::where('id_candidate', '=', $id)->update([
                'doctor' => $request->doctor,
                'psycology' => $request->psycology,
                'admission' => $request->admission,
                'doctor_recommendation' => $request->doctor_recommendation,
                'doctor_date' => $request->doctor_date,
                'doctor_remark' => $request->doctor_remark,
                'psycology_recommendation' => $request->psycology_recommendation,
                'psycology_date' => $request->psycology_date,
                'psycology_remark' => $request->psycology_remark,
            ]);
            $candidateComment = new CandidateComment();
            $candidateComment->description = CANDIDATE_UPDATE_2;
            $candidateComment->created_by = Auth::user()->id;
            $candidateComment->id_candidate = $id;
            $candidateComment->save();
            Candidate::find($id)->update([
                'stage' => $request->stage,
                'id_status' => $request->status,
            ]);

//            $candidateComment = new CandidateComment();
//            $candidateComment->description = $request->comment;
//            $candidateComment->created_by = Auth::user()->id;
//            $candidateComment->id_candidate = $id;
//            $candidateComment->save();

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

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateStep3(Request $request) {
        try {
            $id = $request->input('id');
            CandidateInfo::where('id_candidate', '=', $id)->update([
                'decision_central_commision' => $request->decision_central_commision,
                'date_central_commision' => $request->date_central_commision,
                'general_remark' => $request->general_remark,
            ]);
            Candidate::find($id)->update([
                'stage' => $request->stage,
                'id_status' => $request->status,
            ]);

            $candidateComment = new CandidateComment();
            $candidateComment->description = CANDIDATE_UPDATE_3;
            $candidateComment->created_by = Auth::user()->id;
            $candidateComment->id_candidate = $id;
            $candidateComment->save();

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

    /**
     * Verify the registered account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updateStep4(Request $request) {
        try {
            $id = $request->input('id');
            CandidateInfo::where('id_candidate', '=', $id)->update([
                'date_referal' => $request->date_referal,
                'rehabitation_center' => $request->rehabitation_center,
                'participant_number' => $request->participant_number,
                'date_rehabitation_center' => $request->date_rehabitation_center,
                'type_to_stay' => $request->type_to_stay,
                'participant_remark' => $request->participant_remark,
            ]);
            Candidate::find($id)->update([
                'is_participant' => $request->is_participant,
                'created_participant_time' => Carbon::now()
            ]);

            $candidateComment = new CandidateComment();
            $candidateComment->description = CANDIDATE_UPDATE_4;
            $candidateComment->created_by = Auth::user()->id;
            $candidateComment->id_candidate = $id;
            $candidateComment->save();

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
            $second_street = $request->second_street;
            $second_house_number = $request->second_house_number;
            $second_apartment_number = $request->second_apartment_number;
            $second_post_code = $request->second_post_code;
            $second_post_office = $request->second_post_office;
            $second_city = $request->second_city;
            $voivodeship = $request->voivodeship;
            $community = $request->community;
            $county = $request->county;
            $mobile_phone = $request->mobile_phone;
            $home_phone = $request->home_phone;
            $email = $request->email;
            $family_home_phone = $request->family_home_phone;
            $family_mobile_phone = $request->family_mobile_phone;
            $education = $request->education;
            $academic_title = $request->academic_title;
            $stay_status = $request->stay_status;
            $children_applicable = $request->children_applicable;
            $children_amount = $request->children_amount;
            $children_age = $request->children_age;
            $employed_status = $request->employed_status;
            $employed_type = implode(',', $request->employed_type);
            $employed_in = $request->employed_in;
            $occupation = $request->occupation;
            $unemployed_status = $request->unemployed_status;
            $have_unemployed_person_status = $request->have_unemployed_person_status;
            $unemployed_person_id = $request->unemployed_person_id;
            $long_term_employed_status = $request->long_term_employed_status;
            $seek_work_status = $request->seek_work_status;
            $passive_person_status = $request->passive_person_status;
            $full_time_status = $request->full_time_status;
            $evening_student_status = $request->evening_student_status;
            $disabled_person_status = $request->disabled_person_status;
            $number_certificate = $request->number_certificate;
            $date_of_certificate = $request->date_of_certificate;
            $level_certificate = $request->level_certificate;
            $code_certificate = $request->code_certificate;
            $necessary_certificate = $request->necessary_certificate;
            $ethnic_minority_status = $request->ethnic_minority_status;
            $homeless_person_status = $request->homeless_person_status;
            $stay_house_status = $request->stay_house_status;
            $house_hold_status = $request->house_hold_status;
            $house_hold_adult_status = $request->house_hold_adult_status;
            $uncomfortable_status = $request->uncomfortable_status;
            $stage = $request->stage;
            $id_status = $request->id_status;
            $comment = $request->comment;

            $candidate = new Candidate();
            $candidate->name = $name;
            $candidate->surname = $surname;
            $candidate->person_id = $person_id;
            $candidate->date_of_birth = $date_of_birth;
            $candidate->place_of_birth = $place_of_birth;
            $candidate->street = $street;
            $candidate->house_number = $house_number;
            $candidate->apartment_number = $apartment_number;
            $candidate->post_code = $post_code;
            $candidate->post_office = $post_office;
            $candidate->city = $city;
            $candidate->second_street = $second_street;
            $candidate->second_house_number = $second_house_number;
            $candidate->second_apartment_number = $second_apartment_number;
            $candidate->second_post_code = $second_post_code;
            $candidate->second_post_office = $second_post_office;
            $candidate->second_city = $second_city;
            $candidate->voivodeship = $voivodeship;
            $candidate->community = $community;
            $candidate->county = $county;
            $candidate->mobile_phone = $mobile_phone;
            $candidate->home_phone = $home_phone;
            $candidate->email = $email;
            $candidate->family_home_phone = $family_home_phone;
            $candidate->family_mobile_phone = $family_mobile_phone;
            $candidate->education = $education;
            $candidate->academic_title = $academic_title;
            $candidate->stay_status = $stay_status;
            $candidate->children_applicable = $children_applicable;
            $candidate->children_amount = $children_amount;
            $candidate->children_age = $children_age;
            $candidate->employed_status = $employed_status;
            $candidate->employed_type = $employed_type;
            $candidate->employed_in = $employed_in;
            $candidate->occupation = $occupation;
            $candidate->unemployed_status = $unemployed_status;
            $candidate->have_unemployed_person_status = $have_unemployed_person_status;
            $candidate->unemployed_person_id = $unemployed_person_id;
            $candidate->long_term_employed_status = $long_term_employed_status;
            $candidate->seek_work_status = $seek_work_status;
            $candidate->passive_person_status = $passive_person_status;
            $candidate->full_time_status = $full_time_status;
            $candidate->evening_student_status = $evening_student_status;
            $candidate->disabled_person_status = $disabled_person_status;
            $candidate->number_certificate = $number_certificate;
            $candidate->date_of_certificate = $date_of_certificate;
            $candidate->level_certificate = $level_certificate;
            $candidate->code_certificate = $code_certificate;
            $candidate->necessary_certificate = $necessary_certificate;
            $candidate->ethnic_minority_status = $ethnic_minority_status;
            $candidate->homeless_person_status = $homeless_person_status;
            $candidate->stay_house_status = $stay_house_status;
            $candidate->house_hold_status = $house_hold_status;
            $candidate->house_hold_adult_status = $house_hold_adult_status;
            $candidate->uncomfortable_status = $uncomfortable_status;
            $candidate->stage = $stage;
            $candidate->id_status = $id_status;
            $candidate->status = true;
            $candidate->save();
            $candidate_info = new CandidateInfo();
            $candidate_info->id_candidate = $candidate->id;
            $candidate_info->save();
            $candidate_comment = new CandidateComment();
            $candidate_comment->id_candidate = $candidate->id;
            $candidate_comment->description = CANDIDATE_CREATE;
            $candidate_comment->created_by = Auth::user()->id;
            $candidate_comment->save();
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
            $array = ['name', 'surname', 'person_id', 'place_of_birth', 'date_of_birth', 'street', 'house_number', 'apartment_number', 'post_code', 'post_office', 'city', 'second_street', 'second_house_number',
                'second_apartment_number', 'second_post_code', 'second_post_office', 'second_city', 'voivodeship', 'community', 'county', 'mobile_phone', 'home_phone', 'email', 'family_home_phone',
                'family_mobile_phone', 'education', 'academic_title', 'stay_status', 'children_applicable', 'children_amount', 'children_age', 'employed_status', 'employed_in', 'occupation',
                'unemployed_status', 'have_unemployed_person_status', 'unemployed_person_id', 'long_term_employed_status', 'seek_work_status', 'passive_person_status', 'full_time_status',
                'evening_student_status', 'disabled_person_status', 'number_certificate', 'date_of_certificate', 'level_certificate', 'code_certificate', 'necessary_certificate', 'ethnic_minority_status',
                'homeless_person_status', 'stay_house_status', 'house_hold_status', 'house_hold_adult_status', 'uncomfortable_status'];

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
            $second_street = $request->second_street;
            $second_house_number = $request->second_house_number;
            $second_apartment_number = $request->second_apartment_number;
            $second_post_code = $request->second_post_code;
            $second_post_office = $request->second_post_office;
            $second_city = $request->second_city;
            $voivodeship = $request->voivodeship;
            $community = $request->community;
            $county = $request->county;
            $mobile_phone = $request->mobile_phone;
            $home_phone = $request->home_phone;
            $email = $request->email;
            $family_home_phone = $request->family_home_phone;
            $family_mobile_phone = $request->family_mobile_phone;
            $education = $request->education;
            $academic_title = $request->academic_title;
            $stay_status = $request->stay_status;
            $children_applicable = $request->children_applicable;
            $children_amount = $request->children_amount;
            $children_age = $request->children_age;
            $employed_status = $request->employed_status;
            $employed_type = implode(',',$request->employed_type);
            $employed_in = $request->employed_in;
            $occupation = $request->occupation;
            $unemployed_status = $request->unemployed_status;
            $have_unemployed_person_status = $request->have_unemployed_person_status;
            $unemployed_person_id = $request->unemployed_person_id;
            $long_term_employed_status = $request->long_term_employed_status;
            $seek_work_status = $request->seek_work_status;
            $passive_person_status = $request->passive_person_status;
            $full_time_status = $request->full_time_status;
            $evening_student_status = $request->evening_student_status;
            $disabled_person_status = $request->disabled_person_status;
            $number_certificate = $request->number_certificate;
            $date_of_certificate = $request->date_of_certificate;
            $level_certificate = $request->level_certificate;
            $code_certificate = $request->code_certificate;
            $necessary_certificate = $request->necessary_certificate;
            $ethnic_minority_status = $request->ethnic_minority_status;
            $homeless_person_status = $request->homeless_person_status;
            $stay_house_status = $request->stay_house_status;
            $house_hold_status = $request->house_hold_status;
            $house_hold_adult_status = $request->house_hold_adult_status;
            $uncomfortable_status = $request->uncomfortable_status;
            $comment = $request->comment;

            $id = $request->id;

            $candidate = Candidate::find($id);
            $description = 'Zmiana wartości ';
            $description_array = [];
            for($i = 0; $i < count($array); $i ++){
                if ($candidate[$array[$i]] != $request[$array[$i]]) {
                    if ($array[$i] == 'employed_type') {
                        array_push($description_array,'"'.$array[$i].'" z'.' "'.$request[$array[$i]].' " na "'.implode(',',$candidate[$array[$i]]).'"');
                    } else {
                        array_push($description_array,'"'.$array[$i].'" z'.' "'.$request[$array[$i]].' " na "'.$candidate[$array[$i]].'"');
                    }
                }
            }
            $description = $description.implode(', ', $description_array);

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
                'second_street' => $second_street,
                'second_house_number' => $second_house_number,
                'second_apartment_number' => $second_apartment_number,
                'second_post_code' => $second_post_code,
                'second_post_office' => $second_post_office,
                'second_city' => $second_city,
                'voivodeship' => $voivodeship,
                'community' => $community,
                'county' => $county,
                'mobile_phone' => $mobile_phone,
                'home_phone' => $home_phone,
                'email' => $email,
                'family_home_phone' => $family_home_phone,
                'family_mobile_phone' => $family_mobile_phone,
                'education' => $education,
                'academic_title' => $academic_title,
                'stay_status' => $stay_status,
                'children_applicable' => $children_applicable,
                'children_amount' => $children_amount,
                'children_age' => $children_age,
                'employed_status' => $employed_status,
                'employed_type' => $employed_type,
                'employed_in' => $employed_in,
                'occupation' => $occupation,
                'unemployed_status' => $unemployed_status,
                'have_unemployed_person_status' => $have_unemployed_person_status,
                'unemployed_person_id' => $unemployed_person_id,
                'long_term_employed_status' => $long_term_employed_status,
                'seek_work_status' => $seek_work_status,
                'passive_person_status' => $passive_person_status,
                'full_time_status' => $full_time_status,
                'evening_student_status' => $evening_student_status,
                'disabled_person_status' => $disabled_person_status,
                'number_certificate' => $number_certificate,
                'date_of_certificate' => $date_of_certificate,
                'level_certificate' => $level_certificate,
                'code_certificate' => $code_certificate,
                'necessary_certificate' => $necessary_certificate,
                'ethnic_minority_status' => $ethnic_minority_status,
                'homeless_person_status' => $homeless_person_status,
                'stay_house_status' => $stay_house_status,
                'house_hold_status' => $house_hold_status,
                'house_hold_adult_status' => $house_hold_adult_status,
                'uncomfortable_status' => $uncomfortable_status,
            ]);
            Candidate::find($id)->touch();

            $candidate_comment = new CandidateComment();
            $candidate_comment->id_candidate = $id;
            $candidate_comment->description = $description;
            $candidate_comment->created_by = Auth::user()->id;
            $candidate_comment->save();

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
            $columns = ["id", "name", "surname", "qualification_point", "stage", "id_status", "updated_at"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchName = $request->input('searchName');
            $searchSurname = $request->input('searchSurname');
            $searchQualificationPoint = $request->input('searchQualificationPoint');
            $searchStage = $request->input('searchStage');
            $searchStatus = $request->input('searchStatus');
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
            $tempQualificationArr = QualificationPoint::where('status', '=', 1)->get();
            $qualificationPoint = [];
            if (Auth::user()->id_role == 3) {
                foreach($tempQualificationArr as $item) {
                    $arr = explode(',', $item->ambassador);
                    if (in_array(Auth::user()->id, $arr)) {
                        $qualificationPoint[] = $item->id;
                    }
                }
                $query->whereIn('qualification_point', $qualificationPoint)->orWhere(function ($q) {
                    $q->orWhere('qualification_point', '=', '')->orWhere('qualification_point', '=', null);
                });
            }
            if (intval($searchStage) != 0) {
                $query->where('stage', '=', $searchStage);
            }
            if (intval($searchStatus) != 0) {
                $query->where('id_status', '=', $searchStatus);
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

    public function getHistoryListByOption(Request $request) {
        try {
            $columns = ["candidate_comments.id", "candidate_comments.created_at", "candidate_comments.description", "candidate_comments.created_by"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $id = $request->input('id');
            $searchId = $request->input('searchId');
            $searchCreatedAt = $request->input('searchCreatedAt');
            $searchDescription = $request->input('searchDescription');
            $searchUser = $request->input('searchUser');

            $query = CandidateComment::leftJoin('users', 'candidate_comments.created_by', '=', 'users.id')
                ->where('candidate_comments.description', 'LIKE', "%{$searchDescription}%")->where('candidate_comments.id_candidate', '=', $id);
            if ($searchId != '') {
                $query->where('candidate_comments.id', 'LIKE', "%{$searchId}%");
            }
            if ($searchUser != '') {
                $query->where('users.name', 'LIKE', "%{$searchUser}%");
            }
            if ($searchCreatedAt != 0) {
                $query->where('candidate_comments.created_at', 'LIKE', "%{$searchCreatedAt}%");
            }
            $query->selectRaw('candidate_comments.*, users.name');

            $history_count = $query->get();

            $histories = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [ 'histories' => $histories, 'count' => count($history_count) ]
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
