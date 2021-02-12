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
        'name', 'surname', 'person_id', 'place_of_birth', 'date_of_birth', 'house_number', 'apartment_number', 'post_code', 'post_office', 'street', 'city', 'stage', 'comment', 'qualification_point', 'status'
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
