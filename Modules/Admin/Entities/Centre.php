<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use OwenIt\Auditing\Contracts\Auditable;

use Modules\Client\Entities\Group;
use DB;

class Centre extends Model implements Auditable
{
    use HasFactory, SoftDeletes, Sluggable;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'address_line_1',
        'address_line_2',
        'city',
        'province',
        'creator_id',
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Admin\Database\Factories\CentreFactory::new();
    }


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'creator_id' => 'integer',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name']
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function getClientCountAttribute()
    {
        return DB::table('clients')->where('centre_id',$this->id)->count();
    }
}
