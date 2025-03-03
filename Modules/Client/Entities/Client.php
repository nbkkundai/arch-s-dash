<?php

namespace Modules\Client\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Modules\Upload\Entities\Upload;
use Modules\Admin\Entities\Centre;
use Modules\Client\Entities\ClientNote;
use Modules\Loan\Entities\LoanFraction;

class Client extends Model implements Auditable
{
    use HasFactory, SoftDeletes, Sluggable, Searchable;
    use \OwenIt\Auditing\Auditable;
    public $asYouType = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'id_number',
        'date_of_birth',
        'client_number',
        'sex',
        'marital_status',
        'phone',
        'address_line_1',
        'address_line_2',
        'city',
        'province',
        'address_code',
        'postal_line_1',
        'postal_line_2',
        'postal_code',
        'postal_city',
        'years_in_business',
        'business_type',
        'employment_type',
        'postal_province',
        'postal_code',
        'country_id',
        'client_number',
        'initials',
        'centre_id',
        'creator_id',
        'agreed_to_privacy_policy',
        'slug', //fillable for seeder
    ];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Client\Database\Factories\ClientFactory::new();
    }

    public function SearchableAs(){
        return 'clients_index';
    }

    public function toSearchableArray()
    {
        $array =  [
            'id'=>$this->id,
            'first_name' => $this->first_name,
            'initials' => $this->initials,
            'last_name' => $this->last_name,
            'id_number' => $this->id_number,
            'client_number' => $this->client_number,
        ];
        
        return $array;
    }
    
    /**
    * Sluggable setup
    */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['initials', 'last_name']
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // public function getFullNameAttribute()
    // {
    //     return $this->first_name.' '.$this->last_name;
    // }

    // since clients are now using initials instead of first name
    public function getFullNameAttribute()
    {
        return $this->initials.' '.$this->last_name;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date_of_birth' => 'date',
        'centre_id' => 'integer',
        'creator_id' => 'integer',
        'agreed_to_privacy_policy' => 'boolean',
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function centre()
    {
        return $this->belongsTo(Centre::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function client_notes()
    {
        return $this->hasMany(ClientNote::class);
    }

    public function loan_fractions()
    {
        return $this->hasMany(LoanFraction::class);
    }

    public function uploads()
    {
        return $this->morphMany('Modules\Upload\Entities\Upload', 'uploadable');
    }
 
    public function getDateOfBirthFromIdAttribute()
    {
        $decade = substr($this->id_number,0,2); //e.g. 91
        $month = substr($this->id_number,2,2); //e.g. 05
        $day = substr($this->id_number,4,2); //e.g. 28

        $century = ($decade > 32) ? '19' : '20';

        $date_of_birth = $century.$decade.'-'.$month.'-'.$day;

        return $date_of_birth;
    }
}
