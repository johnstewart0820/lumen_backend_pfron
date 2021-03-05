<?php

namespace App\Models;


class IprSchedule extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_ipr', 'id_service', 'status', 'date', 'start_time', 'end_time', 'break_time', 'total_time', 'total_amount'
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
