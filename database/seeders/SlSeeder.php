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

class SlSeeder extends Seeder
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
        $collection = (new FastExcel)->import(storage_path('/app/sl.xlsx'));
        $voivodeshipList = Voivodeship::all();
        $countyList = County::all();
        $communityList = Community::all();
        $educationList = Educations::all();

        foreach($collection as $item) {
            $surname = $item['surname'];
            $person_id = $item['person_id'];
            $age = self::getAge($person_id);

            $gender = ($item['gender'] == 'kobieta' ? 1 : 2);
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
            $occupation = $item['occupation'];
            $ethnic_minority_status = 0;
            $homeless_person_status = 0;
            $disabled_person_status = 0;
            $uncomfortable_status = 0;

            if ($item['ethnic_minority_status'] == 'Tak')
                $ethnic_minority_status = 1;
            else if ($item['ethnic_minority_status'] == 'Nie')
                $ethnic_minority_status = 2;
            else
                $ethnic_minority_status = 3;

            if ($item['homeless_person_status'] == 'Tak')
                $homeless_person_status = 1;
            else if ($item['homeless_person_status'] == 'Nie')
                $homeless_person_status = 2;
            else
                $homeless_person_status = 3;

            if ($item['disabled_person_status'] == 'Tak')
                $disabled_person_status = 1;
            else if ($item['disabled_person_status'] == 'Nie')
                $disabled_person_status = 2;
            else
                $disabled_person_status = 3;

            if ($item['uncomfortable_status'] == 'Tak')
                $uncomfortable_status = 1;
            else if ($item['uncomfortable_status'] == 'Nie')
                $uncomfortable_status = 2;
            else
                $uncomfortable_status = 3;

            $date_central_commision_str = $item['date_central_commision'];
            $date_central_commision = null;
            $arr_date = explode('x', $date_central_commision_str);
            if (count($arr_date) == 3) {
                $date_central_commision = $arr_date[2] . '-' . $arr_date[0] . '-' . $arr_date[1];
            }
            $arr_doctor_date = explode('x', $item['doctor_date']);
            $doctor_date = $arr_doctor_date[2].'-'.$arr_doctor_date[0].'-'.$arr_doctor_date[1];

            $list = \App\Models\Candidate::where('surname', '=', $surname)->get();
            if (count($list) != 0) {
                \App\Models\Candidate::where('surname', '=', $surname)->update(['person_id' => $person_id, 'age' => $age,
                    'street' => $street, 'house_number' => $house_number, 'apartment_number' => $apartment_number, 'post_code' => $post_code, 'post_office' => $post_office,
                    'city' => $city, 'voivodeship' => $voivodeship_index, 'community' => $community_index, 'county' => $county_index,
                    'mobile_phone' => $mobile_phone, 'family_mobile_phone' => $family_mobile_phone, 'email' => $email, 'education' => $education_id, 'employed_status' => $employed_status,
                    'have_unemployed_person_status' => $have_unemployed_person_status, 'passive_person_status' => $passive_person_status,
                    'long_term_employed_status' => $long_term_employed_status, 'employed_type' => $employed_type, 'employed_in' => $employed_in,
                    'disabled_person_status' => $disabled_person_status, 'occupation' => $occupation, 'ethnic_minority_status' => $ethnic_minority_status,
                    'homeless_person_status' => $homeless_person_status, 'uncomfortable_status' => $uncomfortable_status]);
                \App\Models\CandidateInfo::where('id_candidate', '=', $list[0]->id)->update(['id_candidate' => $list[0]->id, 'gender' => $gender,
                    'doctor_date' => $doctor_date, 'psycology_date' => $doctor_date,
                    'date_central_commision' => $date_central_commision]);
            }
        }
    }
}
