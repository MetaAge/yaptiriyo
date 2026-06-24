<?php

namespace Modules\Subscription\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Subscription\Entities\Subscription;
use Modules\Subscription\Entities\SubscriptionFeature;

/**
 * Seeds the 3 canonical plans (Basic / Orta / Pro) with structured feature_key
 * gating values. Idempotent — safe to run repeatedly.
 *
 * Plan id mapping (existing rows, kept to preserve user_subscriptions FKs & IAP ids):
 *   id=10 -> Basic (free, type 5)   [current title: "Free"]
 *   id=1  -> Orta  (399, monthly)   [current title: "Pro"]
 *   id=6  -> Pro   (899, monthly)   [current title: "Premium"]
 *
 * As of Faz 1, the ~5 controllers that ranked freelancers/projects by
 * `title LIKE "%PRO%"/"%PREMIUM%"` now read the structured `search_rank`
 * feature key, so this seeder also applies the user-facing Basic/Orta/Pro
 * rename + pricing safely (ranking no longer depends on the title).
 *
 * Run with:  php artisan db:seed --class="Modules\Subscription\Database\Seeders\PlanFeatureSeeder"
 */
class PlanFeatureSeeder extends Seeder
{
    /** -1 = unlimited (PlanGate::UNLIMITED). */
    protected array $plans = [
        // id => [meta + features]
        10 => [
            'title' => 'Basic',
            'price' => 0,
            'subscription_type_id' => 5,
            'limit' => 10,
            'features' => [
                'main_category_limit' => 1,
                'sub_category_limit'  => 5,
                'monthly_offer_limit' => 10,
                'photo_limit'         => 10,
                'reels_monthly_limit' => 0,
                'story_monthly_limit' => 0,
                'whatsapp_button'     => 0,
                'phone_call'          => 0,
                'urgent_jobs_access'  => 'view_delayed',
                'search_rank'         => 0,
                'homepage_showcase'   => 0,
                'badge'               => null,
                'chat_number_filter'  => 1,
            ],
        ],
        1 => [
            'price' => 399,
            'subscription_type_id' => 1,
            'limit' => 50,
            'features' => [
                'main_category_limit' => 2,
                'sub_category_limit'  => 20,
                'monthly_offer_limit' => 50,
                'photo_limit'         => 50,
                'reels_monthly_limit' => 8,
                'story_monthly_limit' => 15,
                'whatsapp_button'     => 0,
                'phone_call'          => 1,
                'urgent_jobs_access'  => 'full',
                'search_rank'         => 1,
                'homepage_showcase'   => 0,
                'badge'               => 'trusted',
                'chat_number_filter'  => 0,
            ],
        ],
        6 => [
            'price' => 899,
            'subscription_type_id' => 1,
            'limit' => 999999,
            'features' => [
                'main_category_limit' => -1,
                'sub_category_limit'  => -1,
                'monthly_offer_limit' => -1,
                'photo_limit'         => -1,
                'reels_monthly_limit' => -1,
                'story_monthly_limit' => -1,
                'whatsapp_button'     => 1,
                'phone_call'          => 1,
                'urgent_jobs_access'  => 'priority',
                'search_rank'         => 2,
                'homepage_showcase'   => 1,
                'badge'               => 'pro',
                'chat_number_filter'  => 0,
            ],
        ],
    ];

    public function run()
    {
        // Deactivate any plans outside our canonical 3 so they don't appear in the store.
        $canonicalIds = array_keys($this->plans);
        $deactivated = Subscription::whereNotIn('id', $canonicalIds)->where('status', 1)->update(['status' => 0]);
        if ($deactivated > 0) {
            $this->command?->info("PlanFeatureSeeder: deactivated {$deactivated} non-canonical plan(s).");
        }

        foreach ($this->plans as $id => $data) {
            $plan = Subscription::find($id);
            if (!$plan) {
                $this->command?->warn("PlanFeatureSeeder: subscription id={$id} not found — skipped.");
                continue;
            }

            // Update price/type/limit/status — title korunur (admin tarafından değiştirilebilir).
            $plan->update([
                'price' => $data['price'],
                'subscription_type_id' => $data['subscription_type_id'],
                'limit' => $data['limit'],
                'status' => 1,
            ]);

            // Upsert each structured feature_key (idempotent).
            foreach ($data['features'] as $key => $value) {
                SubscriptionFeature::updateOrCreate(
                    ['subscription_id' => $id, 'feature_key' => $key],
                    [
                        'feature_value' => is_null($value) ? null : (string) $value,
                        // keep a human label in the legacy column for admin/UI lists
                        'feature' => $key,
                        'status' => 1,
                    ]
                );
            }

            $this->command?->info("PlanFeatureSeeder: synced '{$plan->title}' (id={$id}) with " . count($data['features']) . ' feature keys.');
        }
    }
}
