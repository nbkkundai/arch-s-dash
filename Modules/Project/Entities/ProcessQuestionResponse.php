<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Project\Entities\ProcessQuestion;
use Modules\Project\Entities\Project;
use Modules\Upload\Entities\Upload;
use Modules\Project\Entities\Process;
use Modules\Project\Entities\ProcessQuestionResponseOption;

class ProcessQuestionResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'process_id',
        'process_question_id',
        'text_answer',
        'single_option_id',
    ];

    protected $casts = [
        'id' => 'integer',
        'project_id' => 'integer',
        'process_id' => 'integer',
        'process_question_id' => 'integer',
        'single_option_id' => 'integer',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Project\Database\factories\ProcessQuestionResponseFactory::new();
    }


    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function processquestion()
    {
        return $this->belongsTo(ProcessQuestion::class);
    }

    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }

    public function singleOption()
    {
        return $this->belongsTo(ProcessQuestionResponseOption::class);
    }
}
