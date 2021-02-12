<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;

class RehabitationCenterPartner extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'center_id', 'name', 'nip', 'regon'
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
