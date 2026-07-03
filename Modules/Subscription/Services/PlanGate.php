<?php

namespace Modules\Subscription\Services;

use Illuminate\Support\Carbon;
use Modules\Subscription\Entities\UserSubscription;

/**
 * PlanGate — single source of truth for subscription feature gating.
 *
 * Replaces the fragile title-string matching (is_pro_user/is_premium_user)
 * with a structured feature_key/feature_value lookup. Usage:
 *
 *   PlanGate::for($userId)->can('whatsapp_button');         // bool
 *   PlanGate::for($userId)->limit('photo_limit');           // int (-1 = unlimited)
 *   PlanGate::for($userId)->value('urgent_jobs_access');    // string
 *   PlanGate::for($userId)->remaining('monthly_offer_limit'); // int
 *   PlanGate::for($userId)->consume('monthly_offer_limit'); // bool (false if over limit)
 */
class PlanGate
{
    /** Sentinel: a limit value of -1 means "unlimited". */
    public const UNLIMITED = -1;

    /** Per-request instance cache keyed by user id. */
    protected static array $cache = [];

    /** feature_key => user_subscriptions counter column. */
    protected const COUNTER_COLUMNS = [
        'monthly_offer_limit' => 'offers_used',
        'reels_monthly_limit' => 'reels_used',
        'story_monthly_limit' => 'stories_used',
    ];

    /** Fallback values = Basic (free) plan, used when a key is missing. */
    protected const DEFAULTS = [
        'main_category_limit' => '1',
        'sub_category_limit'  => '5',
        'monthly_offer_limit' => '10',
        'photo_limit'         => '10',
        'reels_monthly_limit' => '0',
        'story_monthly_limit' => '0',
        'whatsapp_button'     => '0',
        'phone_call'          => '0',
        'urgent_jobs_access'  => 'view_delayed',
        'search_rank'         => '0',
        'homepage_showcase'   => '0',
        'badge'               => null,
        'chat_number_filter'  => '1',
        'commission_type'     => null,
        'commission_rate'     => null,
    ];

    protected int $userId;
    protected ?UserSubscription $userSub = null;
    protected array $features = [];

    protected function __construct(int $userId)
    {
        $this->userId = $userId;
        $this->load();
    }

    public static function for($userId): self
    {
        $userId = (int) $userId;
        if (!isset(self::$cache[$userId])) {
            self::$cache[$userId] = new self($userId);
        }
        return self::$cache[$userId];
    }

    /** Drop a cached instance (e.g. after a plan change). */
    public static function forget($userId): void
    {
        unset(self::$cache[(int) $userId]);
    }

    /**
     * Standard 422 "upgrade required" JSON response used by all gated endpoints,
     * so the app can detect `upgrade_required` and show the right upsell CTA.
     */
    public static function denied(string $featureKey, ?string $msg = null)
    {
        // Telemetry: which features drive upsell moments (pricing signal).
        \Log::info('plan_gate_denied', [
            'feature' => $featureKey,
            'user_id' => auth('sanctum')->id(),
        ]);

        return response()->json([
            'msg' => $msg ?? __('Bu özellik için paketinizi yükseltmeniz gerekiyor.'),
            'upgrade_required' => true,
            'feature' => $featureKey,
        ], 422);
    }

    protected function load(): void
    {
        // Ensure an expired paid plan has been downgraded to Free before we read it.
        if (function_exists('check_and_downgrade_expired_subscription')) {
            check_and_downgrade_expired_subscription($this->userId);
        }

        $this->userSub = UserSubscription::where('user_id', $this->userId)
            ->where('status', 1)
            ->where('payment_status', 'complete')
            ->where('expire_date', '>', now())
            ->with('subscription.features')
            ->latest('id')
            ->first();

        $map = [];
        if ($this->userSub && $this->userSub->subscription) {
            foreach ($this->userSub->subscription->features as $f) {
                if (!empty($f->feature_key)) {
                    $map[$f->feature_key] = $f->feature_value;
                }
            }
        }
        $this->features = $map;
    }

    /** Raw feature value (string|null), falling back to Basic defaults. */
    public function value(string $key, $default = null)
    {
        if (array_key_exists($key, $this->features)) {
            return $this->features[$key];
        }
        return self::DEFAULTS[$key] ?? $default;
    }

    /** Integer limit. -1 means unlimited. */
    public function limit(string $key): int
    {
        return (int) $this->value($key, 0);
    }

    /** Boolean capability flag. */
    public function can(string $key): bool
    {
        $v = $this->value($key, '0');
        return $v === '1' || $v === 1 || $v === true || $v === 'true';
    }

    public function isUnlimited(string $key): bool
    {
        return $this->limit($key) === self::UNLIMITED;
    }

    /** The active UserSubscription (or null when none / free fallback missing). */
    public function userSubscription(): ?UserSubscription
    {
        return $this->userSub;
    }

    public function planTitle(): ?string
    {
        return $this->userSub && $this->userSub->subscription
            ? $this->userSub->subscription->title
            : null;
    }

    /**
     * Remaining quota for a counted feature this period.
     * Returns PHP_INT_MAX for unlimited plans.
     */
    public function remaining(string $key): int
    {
        if ($this->isUnlimited($key)) {
            return PHP_INT_MAX;
        }
        $limit = $this->limit($key);
        $used = $this->used($key);
        return max(0, $limit - $used);
    }

    /** Current usage count for a counted feature (after period reset check). */
    public function used(string $key): int
    {
        $column = self::COUNTER_COLUMNS[$key] ?? null;
        if (!$column || !$this->userSub) {
            return 0;
        }
        $this->resetPeriodIfNeeded();
        return (int) $this->userSub->{$column};
    }

    /**
     * Try to consume one unit of a counted feature.
     * Returns true if allowed (and increments the counter), false if over the limit.
     *
     * The increment is a single conditional UPDATE (atomic at the DB level), so
     * concurrent requests cannot exceed the limit via read-modify-write races.
     */
    public function consume(string $key, int $amount = 1): bool
    {
        $column = self::COUNTER_COLUMNS[$key] ?? null;
        if (!$column) {
            return false; // not a counted feature
        }

        if ($this->isUnlimited($key)) {
            return true;
        }

        if (!$this->userSub) {
            return false; // no active plan to count against
        }

        $this->resetPeriodIfNeeded();

        $limit = $this->limit($key);

        // Atomic conditional increment: only succeeds when the new total stays
        // within the limit. affected == 0 → limit reached (or row changed).
        $affected = UserSubscription::where('id', $this->userSub->id)
            ->where($column, '<=', $limit - $amount)
            ->update([$column => \DB::raw("`{$column}` + {$amount}")]);

        if ($affected === 0) {
            return false;
        }

        // Keep the in-memory model in sync for subsequent used()/remaining() calls.
        $this->userSub->{$column} = (int) $this->userSub->{$column} + $amount;
        return true;
    }

    /**
     * Reset usage counters once the monthly period has elapsed.
     * Period is anchored on usage_period_start; first use initialises it.
     */
    protected function resetPeriodIfNeeded(): void
    {
        if (!$this->userSub) {
            return;
        }

        $start = $this->userSub->usage_period_start;

        if (empty($start)) {
            $this->userSub->usage_period_start = now();
            $this->userSub->save();
            return;
        }

        if (Carbon::parse($start)->addMonth()->isPast()) {
            $this->userSub->offers_used = 0;
            $this->userSub->reels_used = 0;
            $this->userSub->stories_used = 0;
            $this->userSub->usage_period_start = now();
            $this->userSub->save();
        }
    }
}
