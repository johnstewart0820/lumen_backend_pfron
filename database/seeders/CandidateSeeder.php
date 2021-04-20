<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Community;
use App\Models\County;
use App\Models\Educations;
use App\Models\QualificationPoint;
use App\Models\RehabitationCenterQuater;
use App\Models\Specialist;
use App\Models\Voivodeship;
use Illuminate\Database\Seeder;
use Rap2hpoutre\FastExcel\FastExcel;
use Storage;

class CandidateSeeder extends Seeder
{
    public static function getAge($p)
    {
        $basePesel = strval($p);
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

    public static function getFullDate($p)
    {
        $basePesel = strval($p);
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
            $age = self::getAge($person_id);
            $date_of_birth = self::getFullDate($person_id);
            if ($age == null || $date_of_birth == null) {
                Storage::append('file.txt', 'name => '.$name.' surname => '.$surname.' person_id => '.strval($person_id));
            }

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
                if ($c->name == $community || $c->name.' - '.$c->type == $community)
                    $community_index = $c->id;
            }
            $city = $item['city'];
            $street = $item['street'];
            $house_number = $item['house_number'];
            $apartment_number = $item['apartment_number'];
            $post_code = $item['post_code'];
            $post_office = '';
            $mobile_phone = '48'.$item['mobile_phone'];
            $family_mobile_phone = '48';
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
            $date_referal = '';
            if ($rehabitation_center > 0) {
                $date_referal = RehabitationCenterQuater::where('center_id', '=', $rehabitation_center)->first()->start_date;
            }
            $doctor_recommendation = ($item['doctor_recommendation'] == 'tak' ? 1 : 2);
            $doctor = $item['doctor'];
            $doctor_id = 0;
            $doc_list = Specialist::where('name', '=', $doctor)->get();
            if (count($doc_list) !== 0) {
                $doctor_id = $doc_list[0]->id;
            }

            if (strlen($doctor) != 0 && $doctor_id == 0)
                Storage::append('file.txt', 'name => '.$name.' surname => '.$surname.' doctor => '.$doctor);
            $psycology_recommendation = ($item['psycology_recommendation'] == 'tak' ? 1 : 2);
            $psycology = $item['psycology'];
            $psycology_id = 0;

            $psyco_list = Specialist::where('name', '=', $psycology)->get();
            if (count($psyco_list) !== 0) {
                $psycology_id = $psyco_list[0]->id;
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
            else if (!$participant_status) {
                $stage = 3;
            }
            if ($participant_status_type > 0 && $rehabitation_center == 0) {
                Storage::append('file.txt', 'name => '.$name.' surname => '.$surname.' participant_number => ');
            }
            $level_certificate = $item['level_certificate'];
            $code_certificate = $item['code_certificate'];
            \App\Models\Candidate::create(['name' => $name, 'surname' => $surname, 'person_id' => $person_id, 'age' => $age, 'date_of_birth' => $date_of_birth,
                'street' => $street, 'house_number' => $house_number, 'apartment_number' => $apartment_number, 'post_code' => $post_code, 'post_office' => $post_office,
                'city' => $city, 'voivodeship' => $voivodeship_index, 'community' => $community_index, 'county' => $county_index,
                'mobile_phone' => $mobile_phone, 'family_mobile_phone' => $family_mobile_phone, 'email' => $email, 'education' => $education_id, 'employed_status' => $employed_status,
                'have_unemployed_person_status' => $have_unemployed_person_status, 'passive_person_status' => $passive_person_status,
                'long_term_employed_status' => $long_term_employed_status, 'employed_type' => $employed_type, 'employed_in' => $employed_in,
                'disabled_person_status' => $disabled_person_status, 'level_certificate' => $level_certificate, 'code_certificate' => $code_certificate,
                'qualification_point' => $qualification_point_id, 'is_participant' => $stage == 4, 'status' => 1, 'stage' => $stage, 'id_status' => $id_status,
                'participant_status_type' => $participant_status_type]);
            $id = Candidate::orderBy('id', 'desc')->first()->id;
            \App\Models\CandidateInfo::create(['id_candidate' => $id, 'gender' => $gender, 'doctor' => $doctor_id, 'psycology' => $psycology_id, 'admission' => 1,
                'doctor_recommendation' => $doctor_recommendation, 'psycology_recommendation' => $psycology_recommendation, 'decision_central_commision' => $decision_central_commision,
                'date_central_commision' => $date_central_commision, 'rehabitation_center' => $rehabitation_center, 'participant_number' => $participant_number, 'date_rehabitation_center' => $date_referal]);
        }
    }
}
