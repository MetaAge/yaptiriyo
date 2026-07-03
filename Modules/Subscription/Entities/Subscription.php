<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    /**
     * Canonical plan ids (single source of truth — do NOT hardcode 10/1/6
     * elsewhere). Kept as existing DB row ids to preserve user_subscriptions
     * FKs and store product mappings.
     */
    public const FREE_PLAN_ID = 10; // Basic (free)
    public const ORTA_PLAN_ID = 1;  // Orta (mid tier)
    public const PRO_PLAN_ID  = 6;  // Pro (top tier)

    protected $fillable = [
        'subscription_type_id',
        'title',
        'logo',
        'price',
        'limit',
        'status',
        'commission_rate',
        'commission_type',
        'apple_product_id',
        'google_product_id'
    ];

    protected $casts = ['status' => 'integer'];

    protected static function newFactory()
    {
        return \Modules\Subscription\Database\factories\SubscriptionFactory::new();
    }

    public function features()
    {
        return $this->hasMany(SubscriptionFeature::class, 'subscription_id', 'id');
    }

    /**
     * Read a structured feature value for this plan by its key.
     * Returns null when the key is not set on the plan.
     */
    public function feature($key)
    {
        $feature = $this->features->firstWhere('feature_key', $key);
        return $feature?->feature_value;
    }

    public function subscription_type()
    {
        return $this->belongsTo(SubscriptionType::class, 'subscription_type_id', 'id');
    }

    public function user_subscriptions()
    {
        return $this->hasMany(UserSubscription::class, 'subscription_id', 'id');
    }


    public function getEffectiveCommissionRate()
    {
        if ($this->commission_rate !== null && $this->commission_type !== null) {
            return [
                'rate' => $this->commission_rate,
                'type' => $this->commission_type
            ];
        }

        // Fallback to global settings
        return [
            'rate' => get_static_option('admin_commission_charge') ?? 25,
            'type' => get_static_option('admin_commission_type') ?? 'percentage'
        ];
    }

    public function hasCustomCommission()
    {
        return $this->commission_rate !== null && $this->commission_type !== null;
    }
}
