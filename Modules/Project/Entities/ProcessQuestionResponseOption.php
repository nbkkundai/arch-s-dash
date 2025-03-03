<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Project\Entities\ProcessQuestionResponse;
use Modules\Project\Entities\ProcessQuestionOption;

class ProcessQuestionResponseOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'process_question_response_id',
        'process_question_option_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'process_question_response_id' => 'integer',
        'process_question_option_id' => 'integer',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Project\Database\factories\ProcessQuestionResponseOptionFactory::new();
    }

    public function processQuestionResponse()
    {
        return $this->belongsTo(ProcessQuestionResponse::class);
    }

    public function processQuestionOption()
    {
        return $this->belongsTo(ProcessQuestionOption::class);
    }
}
