<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionFeature extends Model
{
    use HasFactory;

    protected $fillable = ['subscription_id','feature','feature_key','feature_value','status'];

    protected static function newFactory()
    {
        return \Modules\Subscription\Database\factories\SubscriptionFeatureFactory::new();
    }
}
