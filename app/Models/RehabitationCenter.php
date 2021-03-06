<?php

namespace App\Models;


use Tymon\JWTAuth\Contracts\JWTSubject;

class RehabitationCenter extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'contact_number', 'leader_name', 'leader_regon_number', 'leader_nip_number', 'macroregion_number', 'contact', 'position', 'phone', 'email'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $primaryKey = 'id';

    public function partners()
    {
        return $this->hasMany(RehabitationCenterPartner::class, 'center_id', 'id');
    }

}
