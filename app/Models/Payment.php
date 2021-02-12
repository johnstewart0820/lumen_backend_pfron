<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Tymon\JWTAuth\Contracts\JWTSubject;

class Payment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value', 'rehabitation_center', 'service', 'status'
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
