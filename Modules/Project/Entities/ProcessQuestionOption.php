<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Project\Entities\ProcessQuestion;

class ProcessQuestionOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'name',
        'process_question_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'process_question_id' => 'integer',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Project\Database\factories\ProcessQuestionOptionFactory::new();
    }

    public function processQuestion()
    {
        return $this->belongsTo(ProcessQuestion::class);
    }
}
