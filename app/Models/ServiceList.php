<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;

class ServiceList extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'module', 'amount_usage', 'unit', 'amount_takes', 'is_required', 'not_applicable', 'status'
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
