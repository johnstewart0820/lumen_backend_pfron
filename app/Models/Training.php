<?php

namespace App\Models;


class Training extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'number', 'rehabitation_center', 'service', 'participant', 'training_status', 'status'
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
