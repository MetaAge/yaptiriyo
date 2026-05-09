<?php

namespace Modules\PromoteFreelancer\Http\Controllers\Backend;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PromoteTransactionFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function fee_settings(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate(['promote_transaction_fee_type' => 'required', 'promote_transaction_fee_charge' => 'required|numeric|min:0']);
            $all_fields = ['promote_transaction_fee_type', 'promote_transaction_fee_charge'];

            foreach ($all_fields as $field) {
                update_static_option($field, $request->$field);
            }
            toastr_success(__('Transaction Fee Settings Updated Successfully.'));
            return back();
        }
        return view('promotefreelancer::backend.transaction-fee-settings.transaction-fee-settings');
    }

    public function projects_perpage_settings(Request $request)
    {
        if ($request->isMethod('post')) {

            $defaultFirst = $request->has('pro_projects_default_first') ? 1 : 0;
            $promotedBadgeTextToggle = $request->has('promoted_badge_text_toggle') ? 1 : 0;

            // Validation rules
            $rules = [
                'projects_per_page' => 'required|numeric|min:1|max:100',
            ];

            // If toggle is ON then validate the ratio fields
            if ($defaultFirst == 1) {
                $rules['pro_projects_count'] = 'required|numeric|min:0|max:100';
                $rules['non_pro_projects_count'] = 'required|numeric|min:0|max:100';
            }

            if ($promotedBadgeTextToggle == 1) {
                $rules['promoted_badge_text'] = 'required|string|max:255';
            }

            $request->validate($rules);

            if ($defaultFirst == 1) {
                $sum = $request->pro_projects_count + $request->non_pro_projects_count;
                if ($sum != $request->projects_per_page) {
                    return back()->withErrors([
                        'pro_projects_count' => __('The sum of Pro and Non-Pro must equal Per Page (' . $request->projects_per_page . ').'),
                    ])->withInput();
                }
            }

            update_static_option('projects_per_page', $request->projects_per_page);
            update_static_option('pro_projects_default_first', $defaultFirst);
            update_static_option('pro_projects_count', $request->pro_projects_count);
            update_static_option('non_pro_projects_count', $request->non_pro_projects_count);
            update_static_option('promoted_user_profile_text', $request->promoted_user_profile_text);

            if ($promotedBadgeTextToggle) {
                update_static_option('promoted_badge_text', $request->promoted_badge_text);
                update_static_option('promoted_badge_text_toggle', $request->promoted_badge_text_toggle);
            } else {
                update_static_option('promoted_badge_text', null);
                update_static_option('promoted_badge_text_toggle', $request->promoted_badge_text_toggle);
            }

            toastr_success(__('Data Per Page Settings Updated Successfully.'));
            return back();
        }

        return view('PromoteFreelancer::backend.project-settings.projects-perpage-settings');
    }
}
