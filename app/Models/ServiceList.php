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
        'name', 'module', 'type', 'amount_usage', 'unit', 'amount_takes', 'is_required', 'not_applicable', 'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function ipr_plans()
    {
        return $this->hasMany(IprPlan::class, 'id_service', 'id');
    }
    public function ipr_schedules()
    {
        return $this->hasMany(IprSchedule::class, 'id_service', 'id');
    }
    public function ipr_balances()
    {
        return $this->hasMany(IprBalance::class, 'id_service', 'id');
    }
    protected $primaryKey = 'id';

}
