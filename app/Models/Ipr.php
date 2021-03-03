<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;

class Ipr extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_candidate', 'ipr_type', 'number', 'id_ork_person', 'profession', 'schedule_date', 'status'
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
