<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BuildingType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Project\Database\factories\BuildingTypeFactory::new();
    }
}
