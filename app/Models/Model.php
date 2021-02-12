<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

/**
 * @property object old_values;
 */
abstract class Model extends EloquentModel implements ContractsAuditable
{
    use Auditable;
}
