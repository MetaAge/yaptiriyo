<?php

namespace Modules\CountryManage\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Neighborhood extends Model
{
    use HasFactory;

    protected $fillable = ['neighborhood','country_id','state_id','city_id','status'];
    protected $casts = ['status'=>'integer'];

    public static function all_neighborhoods()
    {
        return self::select(['id','neighborhood','country_id','state_id','city_id','status'])->where('status',1)->get();
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
