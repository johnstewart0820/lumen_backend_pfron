<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use App\Models\CandidateComment;
use App\Models\CandidateInfo;
use App\Models\Community;
use App\Models\County;
use App\Models\Educations;
use App\Models\EmployedType;
use App\Models\ParticipantStatusType;
use App\Models\Payment;
use App\Models\QualificationPoint;
use App\Models\QualificationPointType;
use App\Models\RehabitationCenter;
use App\Models\ServiceList;
use App\Models\Specialist;
use App\Models\Stage;
use App\Models\Status;
use App\Models\Voivodeship;
use Database\Seeders\EmployedTypeSeeder;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParticipantController extends Controller
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
            $rehabitationCenter = RehabitationCenter::all();
            $participantStatusType = ParticipantStatusType::all();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'rehabitation_center' => $rehabitationCenter,
                    'participant_status_type' => $participantStatusType
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
            $candidate_info = CandidateInfo::where('id_candidate', '=', $id)->first();
            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [
                    'candidate' => $candidate,
                    'candidate_info' => $candidate_info
                ]
            ]);
        } catch (Exception $e) {
            return response()->json([
                'code' => SERVER_ERROR_CODE,
                'message' => SERVER_ERROR_MESSAGE
            ]);
        }
    }

    public static function getAge($basePesel)
    {
        if (strlen($basePesel) < 11)
            return null;
        $arrSteps = array(1, 3, 7, 9, 1, 3, 7, 9, 1, 3);
        $intSum = 0;
        for ($i = 0; $i < 10; $i++)
        {
            $intSum += $arrSteps[$i] * $basePesel[$i];
        }
        $int = 10 - $intSum % 10;
        $intControlNr = ($int == 10) ? 0 : $int;

        if ($intControlNr == $basePesel[10])
        {
            $rok = substr($basePesel, 0, 2);
            $liczba = substr($basePesel, 2, 2);

            $pesel = $basePesel;
            if (substr($pesel, 2, 2) > 12)
            {
                $miesiac = (int)substr($pesel, 2, 2)-20;
                if ($miesiac < 10)
                {
                    $miesiac = '0'.$miesiac;
                }
            } else {
                $miesiac = substr($pesel, 2, 2);
            }
            $data = (substr($pesel, 2, 2) > 12 ? '20' : '19').substr($pesel, 0, 2).$miesiac.substr($pesel, 4, 2);

            $dt1 = new \DateTime(date('c'));
            $dt2 = \DateTime::createFromFormat('Ymd', $data);

            $interval = $dt1->diff($dt2);

            return $interval->y;
        }

        return null;
    }

    public static function getFullDate($basePesel)
    {
        if (strlen($basePesel) < 11)
            return null;
        $arrSteps = array(1, 3, 7, 9, 1, 3, 7, 9, 1, 3);
        $intSum = 0;
        for ($i = 0; $i < 10; $i++)
        {
            $intSum += $arrSteps[$i] * $basePesel[$i];
        }
        $int = 10 - $intSum % 10;
        $intControlNr = ($int == 10) ? 0 : $int;

        if ($intControlNr == $basePesel[10])
        {
            $rok = substr($basePesel, 0, 2);
            $liczba = substr($basePesel, 2, 2);

            $pesel = $basePesel;
            if (substr($pesel, 2, 2) > 12)
            {
                $miesiac = (int)substr($pesel, 2, 2)-20;
                if ($miesiac < 10)
                {
                    $miesiac = '0'.$miesiac;
                }
            } else {
                $miesiac = substr($pesel, 2, 2);
            }
            $data = (substr($pesel, 2, 2) > 12 ? '20' : '19').substr($pesel, 0, 2).$miesiac.substr($pesel, 4, 2);

            $dt2 = \DateTime::createFromFormat('Ymd', $data);

            return $dt2;
        }

        return null;
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
            $date_of_birth = self::getFullDate($request->person_id);
            $age = self::getAge($person_id);
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
            $participant_status_type = $request->participant_status_type;
            $id = $request->id;

            Candidate::find($id)->update([
                'name' => $name,
                'surname' => $surname,
                'person_id' => $person_id,
                'age' => $age,
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
                'participant_status_type' => $participant_status_type,
            ]);
            Candidate::find($id)->touch();
            $description = 'Zmiana wartości ';
            $description_array = [];
            $candidate = Candidate::find($id);
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
            $columns = ["candidates.id", "name", "surname", "rehabitation_center", "participant_status_type", "updated_at"];
            $sort_column = $request->input('sort_column');
            $sort_order = $request->input('sort_order');
            $count = $request->input('count');
            $page = $request->input('page');
            $searchId = $request->input('searchId');
            $searchName = $request->input('searchName');
            $searchSurname = $request->input('searchSurname');
            $searchRehabitationCenter = $request->input('searchRehabitationCenter');
            $searchParticipantStatusType = $request->input('searchParticipantStatusType');
            $searchDateModified = $request->input('searchDateModified');

            $participants = [];
            $participants_count = [];

            $query = Candidate::leftJoin('candidate_infos', function($join) {
                $join->on('candidates.id', '=', 'candidate_infos.id_candidate');
            })->where('name', 'LIKE', "%{$searchName}%")->where('surname', 'LIKE', "%{$searchSurname}%")->where('status', '=', true)->where('is_participant', '=', true);
            if ($searchId != '') {
                $query->where('candidates.id', '=', $searchId);
            }
            if (intval($searchRehabitationCenter) != 0) {
                $query->where('rehabitation_center', '=', $searchRehabitationCenter);
            }

            if (intval($searchParticipantStatusType) != 0) {
                $query->where('participant_status_type', '=', $searchParticipantStatusType);
            }
            if ($searchDateModified['from'] != '') {
                $query->where('candidates.updated_at', '>', $searchDateModified['from']);
            }
            if ($searchDateModified['to'] != '') {
                $query->where('candidates.updated_at', '<', $searchDateModified['to']);
            }
            $participants_count = $query->get();

            $participants = $query
                ->orderBy($columns[$sort_column], $sort_order)
                ->skip(($page - 1) * $count)
                ->take($count)
                ->get();

            return response()->json([
                'code' => SUCCESS_CODE,
                'message' => SUCCESS_MESSAGE,
                'data' => [ 'participant' => $participants, 'count' => count($participants_count) ]
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
