<?php

namespace App\Models;

use App\Models\User;
use OwenIt\Auditing\Models\Audit as ModelsAudit;

class Audit extends ModelsAudit
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function getUserAttribute()
    {
        return $this->user()->first();
    }

    public function getRoleAttribute()
    {
        $user = $this->user()->first();
        return $user ? $user->role()->first() : null;
    }
}
