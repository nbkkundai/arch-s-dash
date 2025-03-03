<?php

namespace Modules\Status\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Statusable extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'status_id',
        'statusable_id',
        'statusable_type',
        'user_id',
    ];
}
