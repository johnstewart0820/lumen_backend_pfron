<?php

namespace App\Models;

use App\Models\User;
use OwenIt\Auditing\Models\Audit as ModelsAudit;

/**
 * @property object old_values;
 */
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

    public function getChangesAttribute()
    {
        $old_values = collect($this->old_values);
        $new_values = collect($this->new_values);
        $keys = $old_values->keys()->intersect($new_values->keys());
        $changes = $keys->combine($old_values->zip($new_values));

        return $changes;
    }
}
