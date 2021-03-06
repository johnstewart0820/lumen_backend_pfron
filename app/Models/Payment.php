<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;

class Payment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value', 'rehabitation_center', 'service', 'pricelist_amount', 'pricelist_cost', 'is_flatrate_service', 'status'
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
