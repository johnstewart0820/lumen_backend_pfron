<?php

namespace App\Models;


class TrainingClass extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_training', 'name', 'date', 'start_hour', 'end_hour', 'break_amount', 'total_hour', 'ork_team'
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
