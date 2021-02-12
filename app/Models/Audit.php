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
        $new_values = collect($this->new_values);
        $old_values = collect($this->old_values);
        $keys = $new_values->keys()->merge($old_values->keys());
        $new_values = $new_values->only($keys);
        $old_values = $old_values->only($keys);
        $changes = $keys->mapWithKeys(function ($key) use ($old_values, $new_values) {
            return [ $key => [$old_values[$key] ?? null, $new_values[$key]] ?? null ];
        });

        return $changes;
    }
}
