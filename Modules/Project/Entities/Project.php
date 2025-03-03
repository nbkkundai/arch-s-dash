<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Modules\Stage\Entities\Stage;
use Modules\Project\Entities\BuildingType;
use Log;
use Carbon\Carbon;

class Project extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'location',
        'building_type_id',
        'client_id',
        'budget',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Project\Database\factories\ProjectFactory::new();
    }

    public function client()
    {
        return $this->belongsTo(User::class);
    }
   
    public function architects()
    {
        return $this->belongsToMany(User::class);
    }

    public function building()
    {
        return $this->belongsTo(BuildingType::class);
    }
    
    public function statuses()
    {
        return $this->morphToMany('Modules\Status\Entities\Status', 'statusable')->withTimestamps()->withPivot(['user_id']);
    }

    public function processes()
    { 
        return $this->morphToMany('Modules\Project\Entities\Process', 'processable');
    }
}
