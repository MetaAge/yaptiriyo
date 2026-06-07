<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\CountryManage\Entities\City;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\Neighborhood;
use Modules\CountryManage\Entities\State;

class ProjectServiceArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'country_id',
        'state_id',
        'city_id',
        'neighborhood_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id');
    }
}
