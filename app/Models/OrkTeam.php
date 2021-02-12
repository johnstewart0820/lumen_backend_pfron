<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;

class OrkTeam extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'rehabitation_center', 'specialization', 'is_accepted', 'date_of_acceptance', 'status'
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
