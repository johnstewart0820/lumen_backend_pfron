<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;

class CandidateInfo extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_candidate', 'gender', 'doctor', 'psycology', 'admission', 'doctor_recommendation',
        'doctor_date', 'doctor_remark', 'psycology_recommendation', 'psycology_date', 'psycology_remark', 'decision_central_commision', 'date_central_commision', 'general_remark', 'date_referal',
        'rehabitation_center', 'participant_number', 'date_rehabitation_center', 'type_to_stay', 'participant_remark'
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
