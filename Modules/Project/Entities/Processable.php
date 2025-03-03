<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Processable extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'processable_id',
        'processable_type',
        'process_id',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Project\Database\factories\ProcessableFactory::new();
    }

    public function statuses()
    {
        return $this->morphToMany('Modules\Status\Entities\Status', 'statusable')->withTimestamps();
    }
}
