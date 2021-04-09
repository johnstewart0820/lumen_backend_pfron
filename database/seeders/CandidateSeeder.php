<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Community;
use App\Models\County;
use App\Models\Educations;
use App\Models\QualificationPoint;
use App\Models\Specialist;
use App\Models\Voivodeship;
use Illuminate\Database\Seeder;
use Rap2hpoutre\FastExcel\FastExcel;
use Storage;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collection = (new FastExcel)->import(storage_path('/app/candidate.xlsx'));
        $voivodeshipList = Voivodeship::all();
        $countyList = County::all();
        $communityList = Community::all();
        $educationList = Educations::all();
        $qualificationPointList = QualificationPoint::leftJoin('qualification_point_types', 'qualification_points.type', '=', 'qualification_point_types.id')->selectRaw('qualification_points.*, qualification_point_types.name as type_name')->get();
        $doctorList = Specialist::all();
        foreach($collection as $item) {
            if ($item['name'] == '')
                break;
            $name = $item['name'];
            $surname = $item['surname'];
            $person_id = $item['person_id'];
            $gender = ($item['gender'] == 'mężczyzna' ? 2 : 1);
            $voivodeship = $item['voivodeship'];
            $voivodeship_index = 0;
            foreach($voivodeshipList as $a) {
                if ($a->name == $voivodeship)
                    $voivodeship_index = $a->id;
            }
            $county = $item['county'];
            $county_index = 0;
            foreach($countyList as $b) {
                if ($b->name == $county)
                    $county_index = $b->id;
            }
            $community = $item['community'];
            $community_index = 0;
            foreach($communityList as $c) {
                if ($c->name == $community)
                    $community_index = $c->id;
            }
            $city = $item['city'];
            $street = $item['street'];
            $house_number = $item['house_number'];
            $apartment_number = $item['apartment_number'];
            $post_code = $item['post_code'];
            $mobile_phone = $item['mobile_phone'];
            $email = $item['email'];
            $education = $item['education'];
            $education_id = 0;
            foreach($educationList as $d) {
                if ($d->name == $education)
                    $education_id = $d->id;
            }
            $employ_status1 = $item['employ_status1'];
            $employed_status = 0;
            $have_unemployed_person_status = 0;
            $passive_person_status = 0;
            $long_term_employed_status = 0;
            $employed_type = ',,,,';
            if ($employ_status1 == 'osoba bezrobotna niezarejestrowana w ewidencji urzędów pracy') {
                $employed_status = 2;
            }
            if ($employ_status1 == 'osoba pracująca') {
                $employed_status = 1;
            }
            if ($employ_status1 == 'osoba bezrobotna zarejestrowana w ewidencji urzędów pracy') {
                $employed_status = 2;
                $have_unemployed_person_status = 1;
            }
            if ($employ_status1 == 'osoba bierna zawodowo') {
                $passive_person_status = 1;
            }
            $employ_status2 = $item['employ_status2'];
            if ($employ_status2 == 'osoba długotrwale bezrobotna') {
                $long_term_employed_status = 1;
            }
            if ($employ_status2 == 'osoba pracująca w MMŚP') {
                $employed_type=',1,,,';
            }

            $employed_in = $item['employed_in'];
            $disabled_person_status = ($item['disabled_person_status'] == 'Tak' ? 1 : 2);
            $qualification_point = $item['qualification_point'];
            $qualification_point_id = 0;
            foreach($qualificationPointList as $e) {
                if (strtolower($e->type_name.' '.$e->name ) == strtolower($qualification_point))
                    $qualification_point_id = $e->id;
            }
            $participant_number = $item['participant_number'];
            $rehabitation_center = 0;
            if (strpos($participant_number, 'M1') !== false)
                $rehabitation_center = 1;
            if (strpos($participant_number, 'M2') !== false)
                $rehabitation_center = 2;
            if (strpos($participant_number, 'M3') !== false)
                $rehabitation_center = 3;
            if (strpos($participant_number, 'M4') !== false)
                $rehabitation_center = 4;
            $doctor_recommendation = ($item['doctor_recommendation'] == 'tak' ? 1 : 2);
            $doctor = $item['doctor'];
            $doctor_id = 0;
            foreach($doctorList as $f) {
                if ($f->name == $doctor) {
                    $doctor_id = $f->id;
                    break;
                }
            }
            if (strlen($doctor) != 0 && $doctor_id == 0)
                Storage::append('file.txt', 'name => '.$name.' surname => '.$surname.' doctor => '.$doctor);
            $psycology_recommendation = ($item['psycology_recommendation'] == 'tak' ? 1 : 2);
            $psycology = $item['psycology'];
            $psycology_id = 0;
            foreach($doctorList as $g) {
                if ($g->name == $psycology) {
                    $psycology_id = $g->id;
                    break;
                }
            }
            if (strlen($psycology) != 0 && $psycology_id == 0)
                Storage::append('file.txt', 'name => '.$name.' surname => '.$surname.' psycology => '.$psycology);
            $decision_central_commision = ($item['decision_central_commision'] == 'tak' ? 1 : 2);
            $date_central_commision = $item['date_central_commision'];
            $participant_status = $item['participant_status'];
            $participant_status_type = 0;
            $id_status = 4;
            $stage = 4;
            if ($participant_status == 'Z')
                $participant_status_type = 7;
            else if ($participant_status == 'R') {
                $participant_status_type = 3;
                $stage = 3;
            }
            else if ($participant_status == 'UP')
                $participant_status_type = 9;
            else if ($participant_status == 'NK') {
                $id_status = 3;
                $stage = 3;
            }
            else if ($participant_status == 'R1') {
                $participant_status_type = 4;
            }
            else if ($participant_status == 'UP+P') {
                $participant_status_type = 10;
            }
            else if ($participant_status == 'C') {
                $participant_status_type = 8;
            }
            else if ($participant_status == 'R2') {
                $participant_status_type = 5;
            }
            else if ($participant_status == 'R3') {
                $participant_status_type = 6;
            }
            else if ($participant_status == 'ND') {
                $participant_status_type = 1;
            }
            else if ($participant_status == 'U') {
                $participant_status_type = 2;
            }
            $level_certificate = $item['level_certificate'];
            $code_certificate = $item['code_certificate'];
            \App\Models\Candidate::create(['name' => $name, 'surname' => $surname, 'person_id' => $person_id,
                'street' => $street, 'house_number' => $house_number, 'apartment_number' => $apartment_number, 'post_code' => $post_code,
                'city' => $city, 'voivodeship' => $voivodeship_index, 'community' => $community_index, 'county' => $county_index,
                'mobile_phone' => $mobile_phone, 'email' => $email, 'education' => $education_id, 'employed_status' => $employed_status,
                'have_unemployed_person_status' => $have_unemployed_person_status, 'passive_person_status' => $passive_person_status,
                'long_term_employed_status' => $long_term_employed_status, 'employed_type' => $employed_type, 'employed_in' => $employed_in,
                'disabled_person_status' => $disabled_person_status, 'level_certificate' => $level_certificate, 'code_certificate' => $code_certificate,
                'qualification_point' => $qualification_point_id, 'is_participant' => $stage == 4, 'status' => 1, 'stage' => $stage, 'id_status' => $id_status,
                'participant_status_type' => $participant_status_type]);
            $id = Candidate::orderBy('id', 'desc')->first()->id;
            \App\Models\CandidateInfo::create(['id_candidate' => $id, 'gender' => $gender, 'doctor' => $doctor_id, 'psycology' => $psycology_id, 'admission' => 1,
                'doctor_recommendation' => $doctor_recommendation, 'psycology_recommendation' => $psycology_recommendation, 'decision_central_commision' => $decision_central_commision,
                'date_central_commision' => $date_central_commision, 'rehabitation_center' => $rehabitation_center, 'participant_number' => $participant_number]);
        }
    }
}
