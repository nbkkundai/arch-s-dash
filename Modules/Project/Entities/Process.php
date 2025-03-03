<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Project\Entities\Project;
use Modules\Stage\Entities\Stage;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Project\Entities\ProcessQuestion;
use OwenIt\Auditing\Contracts\Auditable;

class Process extends Model implements Auditable
{
    use HasFactory, Sluggable, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'slug',
        'order',
        'description',
        'instructions',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Project\Database\factories\ProcessFactory::new();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }

    public function questions()
    {
        return $this->hasMany(ProcessQuestion::class);
    }

    public function getRouteKeyName()
    {
        return ‘slug’;
    }

    public function projects()
    {
        return $this->morphedByMany(Project::class, 'processable');
    }
}
