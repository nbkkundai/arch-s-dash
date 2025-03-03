<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use Modules\Project\Entities\Process;
use Modules\Project\Entities\ProcessQuestionOption;

class ProcessQuestion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'process_id',
        'name',
        'type',
        'is_active',
        'is_required',
    ];

    protected $casts = [
        'id' => 'integer',
        'process_id' => 'integer',
        'is_active' => 'boolean',
        'is_required' => 'boolean',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Project\Database\factories\ProcessQuestionFactory::new();
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function options()
    {
        return $this->hasMany(ProcessQuestionOption::class);
    }
}
