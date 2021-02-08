<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use Tymon\JWTAuth\Contracts\JWTSubject;
use OwenIt\Auditing\Contracts\Auditable;



class QualificationPoint extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $auditStrict = true;
    protected $auditInclude = [
        'title',
        'content',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'ambassador', 'status'
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
