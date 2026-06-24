<?php

namespace Modules\Subscription\Services;

use Illuminate\Support\Carbon;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Entities\UserSubscription;

/**
 * Grants the signup free-trial subscription.
 *
 * Every new freelancer gets a free trial of a paid plan (default Orta) so they
 * experience the paid features and convert. The first N freelancers
 * ("founding members") get a longer trial. After the trial expires,
 * check_and_downgrade_expired_subscription() drops them to the free Basic plan.
 *
 * Configurable via static options:
 *   - signup_trial_plan_id   (default 1   = Orta)
 *   - signup_trial_days      (default 30)
 *   - founding_member_limit  (default 0   = feature off)
 *   - founding_member_days   (default 90)
 */
class TrialService
{
    public const FREE_PLAN_ID = 10;

    /**
     * Assign the signup trial to a freshly registered freelancer.
     * Returns the created UserSubscription, or null if no plan could be assigned.
     */
    public static function assignSignupTrial(int $userId): ?UserSubscription
    {
        $trialPlanId = (int) (get_static_option('signup_trial_plan_id') ?: 1);
        $plan = Subscription::find($trialPlanId);

        // Fall back to the free Basic plan if the configured trial plan is missing.
        if (!$plan) {
            return self::assignFreePlan($userId);
        }

        $foundingLimit = (int) (get_static_option('founding_member_limit') ?: 0);
        $isFounding = $foundingLimit > 0
            && UserSubscription::where('is_trial', 1)->count() < $foundingLimit;

        $days = $isFounding
            ? (int) (get_static_option('founding_member_days') ?: 90)
            : (int) (get_static_option('signup_trial_days') ?: 30);

        $endsAt = Carbon::now()->addDays($days);

        // Deactivate any prior subscriptions (defensive — a new signup shouldn't have any).
        UserSubscription::where('user_id', $userId)->where('status', 1)->update(['status' => 0]);

        return UserSubscription::create([
            'user_id'         => $userId,
            'subscription_id' => $plan->id,
            'price'           => 0,
            'limit'           => $plan->limit,
            'expire_date'     => $endsAt,
            'payment_gateway' => 'trial',
            'payment_status'  => 'complete',
            'status'          => 1,
            'is_trial'        => true,
            'trial_ends_at'   => $endsAt,
        ]);
    }

    /** Assign the free Basic plan (used as fallback). */
    public static function assignFreePlan(int $userId): ?UserSubscription
    {
        $free = Subscription::with('subscription_type:id,validity')->find(self::FREE_PLAN_ID);
        if (!$free) {
            return null;
        }

        return UserSubscription::create([
            'user_id'         => $userId,
            'subscription_id' => $free->id,
            'price'           => 0,
            'limit'           => $free->limit,
            'expire_date'     => Carbon::now()->addDays($free->subscription_type->validity ?? 365),
            'payment_gateway' => 'free',
            'payment_status'  => 'complete',
            'status'          => 1,
        ]);
    }
}
