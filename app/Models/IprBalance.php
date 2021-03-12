<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;

class IprBalance extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_ipr', 'id_service', 'amount', 'remarks'
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
