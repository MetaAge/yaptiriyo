<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CountryManage\Entities\City;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\Neighborhood;
use Modules\CountryManage\Entities\State;

class UserAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'address_details',
        'country_id',
        'state_id',
        'city_id',
        'neighborhood_id',
        'zip_code',
        'phone',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }
}
