<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;

class Candidate extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'person_id', 'place_of_birth', 'date_of_birth', 'street', 'house_number', 'apartment_number', 'post_code', 'post_office', 'city', 'second_street', 'second_house_number', 'second_apartment_number',
        'second_post_code', 'second_post_office', 'second_city', 'voivodeship', 'community', 'county', 'mobile_phone', 'home_phone', 'email', 'family_mobile_phone', 'family_home_phone',
        'education', 'academic_title', 'stay_status', 'children_applicable', 'children_amount', 'children_age', 'employed_status', 'employed_type', 'employed_in', 'occupation', 'unemployed_status',
        'have_unemployed_person_status', 'unemployed_person_id', 'long_term_employed_status', 'seek_work_status', 'passive_person_status', 'full_time_status', 'evening_student_status', 'disabled_person_status',
        'number_certificate', 'date_of_certificate', 'level_certificate', 'code_certificate', 'necessary_certificate', 'ethnic_minority_status', 'homeless_person_status', 'stay_house_status',
        'house_hold_status', 'house_hold_adult_status', 'uncomfortable_status', 'stage', 'id_status', 'is_participant', 'qualification_point', 'status',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $primaryKey = 'id';

}
