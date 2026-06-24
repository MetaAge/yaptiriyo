<?php

namespace App\Http\Controllers\Api\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\UserWork;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\Service\Entities\SubCategory;
use Modules\Subscription\Services\PlanGate;

/**
 * Freelancer self-service management of the categories / sub-categories they work in.
 *
 * Supports multiple (category, sub_category) pairs per freelancer, with the
 * number of distinct main categories and sub-categories capped by the
 * subscription plan (main_category_limit / sub_category_limit via PlanGate).
 *
 * The oldest row (lowest id) remains the "primary" so existing single-category
 * reads that use UserWork::where('user_id',..)->first() keep working unchanged.
 */
class WorkCategoryController extends Controller
{
    public function index()
    {
        $userId = auth('sanctum')->user()->id;

        $works = UserWork::with(['category:id,category', 'sub_category:id,sub_category,category_id'])
            ->where('user_id', $userId)
            ->orderBy('id')
            ->get();

        $gate = PlanGate::for($userId);
        $mainLimit = $gate->limit('main_category_limit');
        $subLimit = $gate->limit('sub_category_limit');

        $usedMain = $works->pluck('category_id')->unique()->count();
        $usedSub = $works->pluck('sub_category_id')->filter()->unique()->count();

        return response()->json([
            'status' => 'success',
            'works' => $works,
            'limits' => [
                'main_category_limit' => $mainLimit,
                'sub_category_limit'  => $subLimit,
                'main_used'           => $usedMain,
                'sub_used'            => $usedSub,
                'main_remaining'      => $mainLimit === PlanGate::UNLIMITED ? null : max(0, $mainLimit - $usedMain),
                'sub_remaining'       => $subLimit === PlanGate::UNLIMITED ? null : max(0, $subLimit - $usedSub),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'     => ['required', Rule::exists('categories', 'id')],
            'sub_category_id' => ['nullable', Rule::exists('sub_categories', 'id')],
        ]);

        $userId = auth('sanctum')->user()->id;
        $categoryId = (int) $request->category_id;
        $subCategoryId = $request->filled('sub_category_id') ? (int) $request->sub_category_id : null;

        // Sub-category must belong to the given category.
        if ($subCategoryId) {
            $belongs = SubCategory::where('id', $subCategoryId)->where('category_id', $categoryId)->exists();
            if (!$belongs) {
                return response()->json([
                    'msg' => __('Seçilen alt kategori bu kategoriye ait değil.'),
                ], 422);
            }
        }

        $existing = UserWork::where('user_id', $userId)->get();

        // Reject exact duplicate pair.
        $duplicate = $existing->first(function ($w) use ($categoryId, $subCategoryId) {
            return (int) $w->category_id === $categoryId
                && (int) $w->sub_category_id === (int) $subCategoryId;
        });
        if ($duplicate) {
            return response()->json([
                'msg' => __('Bu kategori zaten ekli.'),
            ], 422);
        }

        $gate = PlanGate::for($userId);

        // Main-category limit: only blocks when introducing a NEW distinct category.
        $distinctCats = $existing->pluck('category_id')->unique();
        $mainLimit = $gate->limit('main_category_limit');
        if (!$distinctCats->contains($categoryId)
            && $mainLimit !== PlanGate::UNLIMITED
            && $distinctCats->count() >= $mainLimit) {
            return PlanGate::denied(
                'main_category_limit',
                __('Ana kategori limitinize ulaştınız (:limit). Daha fazlası için paketinizi yükseltin.', ['limit' => $mainLimit])
            );
        }

        // Sub-category limit: only blocks when introducing a NEW distinct sub-category.
        $distinctSubs = $existing->pluck('sub_category_id')->filter()->unique();
        $subLimit = $gate->limit('sub_category_limit');
        if ($subCategoryId
            && !$distinctSubs->contains($subCategoryId)
            && $subLimit !== PlanGate::UNLIMITED
            && $distinctSubs->count() >= $subLimit) {
            return PlanGate::denied(
                'sub_category_limit',
                __('Alt kategori limitinize ulaştınız (:limit). Daha fazlası için paketinizi yükseltin.', ['limit' => $subLimit])
            );
        }

        $work = UserWork::create([
            'user_id'         => $userId,
            'category_id'     => $categoryId,
            'sub_category_id' => $subCategoryId,
        ]);

        return response()->json([
            'status' => 'success',
            'msg'    => __('Kategori başarıyla eklendi.'),
            'work'   => $work->load(['category:id,category', 'sub_category:id,sub_category,category_id']),
        ]);
    }

    public function destroy($id)
    {
        $userId = auth('sanctum')->user()->id;

        $work = UserWork::where('user_id', $userId)->findOrFail($id);
        $work->delete();

        return response()->json([
            'status' => 'success',
            'msg'    => __('Kategori kaldırıldı.'),
        ]);
    }
}
