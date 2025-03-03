<?php

namespace Modules\Status\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Client\Entities\Client;
use Modules\Loan\Entities\Loan;
use Modules\Client\Entities\Group;

class Status extends Model
{
    protected $fillable = [
        'model',
        'name',
        'code',
        'description',
    ];

    /**
     * relationshipts
     */

    public function clients()
    {
        return $this->morphedByMany(User::class, 'statusable');
    }

    public function groups()
    {
        return $this->morphedByMany(Group::class, 'statusable');
    }

    public function loans()
    {
        return $this->morphedByMany(Loan::class, 'statusable');
    }

    public function users()
    {
        return $this->morphedByMany(Client::class, 'statusable');
    }

}
