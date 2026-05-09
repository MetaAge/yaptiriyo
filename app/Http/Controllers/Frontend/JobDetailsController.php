<?php

namespace App\Http\Controllers\Frontend;

use App\Events\ProjectEvent;
use App\Http\Controllers\Controller;
use App\Models\JobPost;
use App\Models\JobProposal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Modules\CurrencySwitcher\App\Models\SelectedCurrencyList;
use Modules\Subscription\Entities\UserSubscription;

class JobDetailsController extends Controller
{
    public function job_details($username = null, $slug = null)
    {
        $job_details = JobPost::with(['job_creator' => function ($q) {
            $q->where('user_active_inactive_status', 1);
        },  'job_category','job_skills', 'job_proposals' , 'job_category'])
            ->where('slug', $slug)
            ->first();

        if (!empty($job_details) && $job_details->job_creator) {
            $user = $job_details->job_creator->load('user_country');

            $restrictionEnabled = get_static_option('job_country_restriction_enabled', 0);
            $viewLevelEnabled = get_static_option('job_country_view_level_enabled', 0);
            $canApply = true;
            $canView = true;
            $restrictionMessage = '';
            $requiresProfileUpdate = false;
            $isCountryRestricted = false;
            $countryRestrictionMessage = '';

            if ($restrictionEnabled && Auth::check()) {
                $freelancerCountry = Auth::user()->country_id;

                // Check if this job should be viewable (using existing private method)
                $shouldBeViewable = $this->shouldJobBeViewableInListing($job_details, $freelancerCountry);

                if (!$shouldBeViewable && $viewLevelEnabled) {
                    return back()->with(toastr_warning(__('This job is not available in your country.')));
                }

                // DIRECTLY CHECK COUNTRY RESTRICTION HERE (duplicate logic)
                if (!$freelancerCountry) {
                    $canApply = false;
                    $restrictionMessage = __('Please complete your profile with country information to apply for jobs.');
                    $requiresProfileUpdate = true;
                    $isCountryRestricted = true;
                    $countryRestrictionMessage = __('Please complete your profile with country information to apply for jobs.');
                } else {
                    // Check country restriction logic directly
                    if (
                        empty($job_details->country_restriction_type) ||
                        $job_details->country_restriction_type === 'none' ||
                        $job_details->country_restriction_type === ''
                    ) {
                        // No restriction
                    } elseif ($job_details->country_restriction_type === 'include') {
                        // Include mode: only allowed countries can access
                        $allowed = $job_details->allowed_countries ?? [];
                        if (!in_array($freelancerCountry, $allowed)) {
                            $canApply = false;
                            $restrictionMessage = __('This job is only available for specific countries.');
                            $isCountryRestricted = true;
                            $countryRestrictionMessage = __('This job is only available for specific countries.');
                        }
                    } elseif ($job_details->country_restriction_type === 'exclude') {
                        // Exclude mode: excluded countries cannot access
                        $excluded = $job_details->excluded_countries ?? [];
                        if (in_array($freelancerCountry, $excluded)) {
                            $canApply = false;
                            $restrictionMessage = __('This job is not available in your country.');
                            $isCountryRestricted = true;
                            $countryRestrictionMessage = __('This job is not available in your country.');
                        }
                    }
                }
            }

            if (Auth::check() && Auth::user()->user_type == 1) {
                $canApply = false;
                $restrictionMessage = __('Only freelancers can apply to jobs.');
            }

            if (Auth::check() && Auth::user()->id == $job_details->user_id) {
                $canApply = false;
                $restrictionMessage = __('You cannot apply to your own job.');
            }

            return view('frontend.pages.job-details.job-details', compact(
                'job_details',
                'user',
                'canApply',
                'restrictionMessage',
                'requiresProfileUpdate',
                'isCountryRestricted',
                'countryRestrictionMessage'
            ));
        }

        return back();
    }

    //job proposal
    public function job_proposal_send(Request $request)
    {
        // Add this at the very beginning to handle AJAX requests properly
        if ($request->ajax() || $request->wantsJson()) {
            return $this->handleAjaxProposal($request);
        }

        // Keep your original method logic for non-AJAX requests below
        // ... (your existing non-AJAX code)
    }

    private function handleAjaxProposal(Request $request)
    {
        try {
            // Validate the request
            $validator = \Validator::make($request->all(), [
                'client_id' => 'required',
                'amount' => 'required|numeric|gt:0',
                'duration' => 'required',
                'revision' => 'required|integer|min:0|max:100',
                'cover_letter' => 'required|string|min:10|max:1000',
                'attachment' => 'nullable|mimes:png,jpg,jpeg,bmp,gif,tiff,svg,csv,txt,xlx,xls,pdf,docx|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()->all()
                ], 422);
            }

            // Check for restricted words
            if (moduleExists('SecurityManage')) {
                $cover_letter = $request->cover_letter;
                $combinedText = strtolower($cover_letter);
                $restrictedWords = \Modules\SecurityManage\Entities\Word::where('status', 'active')->pluck('word')->toArray();
                $matchedWords = array_filter($restrictedWords, function($word) use ($combinedText) {
                    return strpos($combinedText, strtolower($word)) !== false;
                });

                if (count($matchedWords) > 0) {
                    return response()->json([
                        'success' => false,
                        'errors' => [__('You cannot use restricted words: ') . implode(', ', $matchedWords)]
                    ], 422);
                }
            }

            $freelancer_id = Auth::guard('web')->user()->id;

           // Check if user is suspended FIRST
            if (Auth::guard('web')->user()->is_suspend == 1) {
                return response()->json([
                    'success' => false,
                    'errors' => [__('You can not send job proposal because your account is suspended. please try to contact admin')]
                ], 422);
            }

            // Check if proposal already exists AFTER other validations
            $check_freelancer_proposal = JobProposal::where('freelancer_id', $freelancer_id)
                ->where('job_id', $request->job_id)
                ->first();

            if ($check_freelancer_proposal) {
                return response()->json([
                    'success' => false,
                    'errors' => [__('You can not send one more proposal.')]
                ], 422);
            }

            // Get job details
            $job_details = JobPost::find($request->job_id);
            if (!$job_details) {
                return response()->json([
                    'success' => false,
                    'errors' => [__('Job not found.')]
                ], 422);
            }

            // Check country restrictions
            $restrictionEnabled = get_static_option('job_country_restriction_enabled', 0);
            if ($restrictionEnabled) {
                $freelancerCountry = Auth::user()->country_id;

                if (!$freelancerCountry) {
                    return response()->json([
                        'success' => false,
                        'errors' => [__('Please complete your profile with country information to apply for jobs.')]
                    ], 422);
                }

                if (!empty($job_details->country_restriction_type) &&
                    $job_details->country_restriction_type !== 'none' &&
                    $job_details->country_restriction_type !== '') {

                    if ($job_details->country_restriction_type === 'include') {
                        $allowed = $job_details->allowed_countries ?? [];
                        if (!in_array($freelancerCountry, $allowed)) {
                            return response()->json([
                                'success' => false,
                                'errors' => [__('This job is only available for specific countries.')]
                            ], 422);
                        }
                    } elseif ($job_details->country_restriction_type === 'exclude') {
                        $excluded = $job_details->excluded_countries ?? [];
                        if (in_array($freelancerCountry, $excluded)) {
                            return response()->json([
                                'success' => false,
                                'errors' => [__('This job is not available in your country.')]
                            ], 422);
                        }
                    }
                }
            }

            // Handle currency
            $amount = $request->amount;
            $currency = null;
            $conversion_rate = null;
            $symbol = null;

            if (moduleExists('CurrencySwitcher')) {
                $get_user_currency = SelectedCurrencyList::where('currency', get_currency_according_to_user())->first();
                if ($get_user_currency) {
                    $amount = $get_user_currency->conversion_rate > 0
                        ? ($request->amount / $get_user_currency->conversion_rate)
                        : $request->amount;
                    $currency = $get_user_currency->currency;
                    $conversion_rate = $get_user_currency->conversion_rate;
                    $symbol = $get_user_currency->symbol;
                }
            }

            // Handle file upload
            $attachment_name = null;
            if ($request->hasFile('attachment')) {
                $attachment = $request->file('attachment');
                $attachment_name = time() . '-' . uniqid() . '.' . $attachment->getClientOriginalExtension();

                $imageExtensions = ['png', 'jpg', 'jpeg', 'bmp', 'gif', 'tiff', 'svg'];

                if (in_array($attachment->getClientOriginalExtension(), $imageExtensions)) {
                    $image = Image::make($attachment);
                    $image->resize(1000, 600, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $image->save('assets/uploads/jobs/proposal/' . $attachment_name);
                } else {
                    $attachment->move('assets/uploads/jobs/proposal', $attachment_name);
                }
            }

            // Create the proposal
            $proposal = JobProposal::create([
                'job_id' => $request->job_id,
                'freelancer_id' => Auth::id(),
                'client_id' => $request->client_id,
                'amount' => $amount,
                'duration' => $request->duration,
                'revision' => $request->revision,
                'cover_letter' => $request->cover_letter,
                'attachment' => $attachment_name,
                'currency' => $currency,
                'conversion_rate' => $conversion_rate,
                'symbol' => $symbol,
                'load_from' => 0, // Default to local storage
            ]);

            // Send notification
            client_notification($proposal->id, $request->client_id, 'Proposal', 'You have a new job proposal');
            event(new ProjectEvent(__('You have a new job proposal'), $request->client_id));

            // Log success
            \Log::info('Job proposal created successfully', [
                'proposal_id' => $proposal->id,
                'job_id' => $proposal->job_id,
                'freelancer_id' => $proposal->freelancer_id
            ]);

            return response()->json([
                'success' => true,
                'message' => __('Proposal successfully sent')
            ]);

        } catch (\Exception $e) {
            \Log::error('Error creating job proposal: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());

            return response()->json([
                'success' => false,
                'errors' => [__('An error occurred while sending the proposal. Please try again.')]
            ], 500);
        }
    }

    /**
     * Check if job should be viewable in listing
     */
    private function shouldJobBeViewableInListing($job_details, $freelancerCountry)
    {
        // Jobs with no restrictions are always viewable
        if (
            empty($job_details->country_restriction_type) ||
            $job_details->country_restriction_type === 'none' ||
            $job_details->country_restriction_type === ''
        ) {
            return true;
        }

        // If user has no country, they can only see unrestricted jobs
        if (!$freelancerCountry) {
            return false;
        }

        // Apply country-specific logic for users with countries
        if ($job_details->country_restriction_type === 'include') {
            $allowed = $job_details->allowed_countries ?? [];
            return in_array($freelancerCountry, $allowed);
        }

        if ($job_details->country_restriction_type === 'exclude') {
            $excluded = $job_details->excluded_countries ?? [];
            return !in_array($freelancerCountry, $excluded);
        }

        return true;
    }

    /**
     * Helper method to check country restrictions for apply functionality
     */
    private function checkCountryRestriction($job_details, $freelancerCountry)
    {
        if (!$freelancerCountry) {
            return [
                'allowed' => false,
                'message' => __('Please complete your profile with country information to apply for jobs.'),
                'requires_profile_update' => true
            ];
        }

        if (
            empty($job_details->country_restriction_type) ||
            $job_details->country_restriction_type === 'none' ||
            $job_details->country_restriction_type === ''
        ) {
            return ['allowed' => true, 'message' => ''];
        }

        if ($job_details->country_restriction_type === 'include') {
            // Include mode: only allowed countries can access
            $allowed = $job_details->allowed_countries ?? [];
            if (!in_array($freelancerCountry, $allowed)) {
                return [
                    'allowed' => false,
                    'message' => __('This job is only available for specific countries.')
                ];
            }
        }

        if ($job_details->country_restriction_type === 'exclude') {
            // Exclude mode: excluded countries cannot access
            $excluded = $job_details->excluded_countries ?? [];
            if (in_array($freelancerCountry, $excluded)) {
                return [
                    'allowed' => false,
                    'message' => __('This job is not available in your country.')
                ];
            }
        }

        return ['allowed' => true, 'message' => ''];
    }
}
