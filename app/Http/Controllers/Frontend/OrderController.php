<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Services\Frontend\OrderService;
use App\Models\IndividualCommissionSetting;
use App\Models\JobPost;
use App\Models\JobProposal;
use App\Models\Order;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Chat\Entities\Offer;
use Modules\CurrencySwitcher\App\Models\SelectedCurrencyList;
use Modules\CountryManage\Entities\Country;
use Modules\CountryManage\Entities\State;
use Modules\CountryManage\Entities\City;

class OrderController extends Controller
{
    //user login
    public function user_login(Request $request)
    {
        return (new OrderService())->user_login($request);
    }


    //checkout page
    public function checkout_page(Request $request)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('user.login')->with(toastr_warning(__('Please login first')));
        }

        $project_id = $request->project_id;
        $packageType = $request->package;
        $selectedExtras = json_decode($request->extras ?? '[]', true);
        $totalPrice = $request->total_price;

        $project = Project::with('project_attributes')->where('id', $project_id)->first();

        if (!$project) {
            return redirect()->back()->with(toastr_warning(__('Project not found')));
        }

        $packageMapping = [
            'basic' => $project->basic_title,
            'standard' => $project->standard_title,
            'premium' => $project->premium_title,
        ];

        $packageType = $packageMapping[$packageType] ?? $project->basic_title;

        $basePrice = 0;
        switch ($request->package) {
            case 'basic':
                $basePrice = $project->basic_discount_charge ?? $project->basic_regular_charge;
                break;
            case 'standard':
                $basePrice = $project->standard_discount_charge ?? $project->standard_regular_charge;
                break;
            case 'premium':
                $basePrice = $project->premium_discount_charge ?? $project->premium_regular_charge;
                break;
        }

        $extrasPrice = 0;
        if (!empty($selectedExtras) && $project->project_attributes->count() > 0) {
            foreach ($selectedExtras as $extraId) {
                $attribute = $project->project_attributes->where('id', $extraId)->first();
                if ($attribute) {
                    switch ($request->package) {
                        case 'basic':
                            $extrasPrice += $attribute->basic_extra_price ?? 0;
                            break;
                        case 'standard':
                            $extrasPrice += $attribute->standard_extra_price ?? 0;
                            break;
                        case 'premium':
                            $extrasPrice += $attribute->premium_extra_price ?? 0;
                            break;
                    }
                }
            }
        }

        // Pricing type bilgisi checkout görünümüne taşınır: m²/saat/adet
        // ilanlarında miktar seçici gösterilir, toplam = birim fiyat × miktar.
        $pricingType = $project->pricing_type ?? \App\Enums\PricingType::FIXED;
        $requiresQuantity = \App\Enums\PricingType::requiresQuantity($pricingType);
        $quantity = max(1, (float) ($request->quantity ?? 1));
        $unitPrice = $basePrice;
        if ($requiresQuantity) {
            $basePrice = round($basePrice * $quantity, 2);
        }

        $finalPrice = $requiresQuantity
            ? ($basePrice + $extrasPrice)
            : ($totalPrice ?: ($basePrice + $extrasPrice));

        $countries = Country::where('status', 1)->get();

        return view('frontend.pages.order.gateway-markup', compact(
            'project',
            'packageType',
            'selectedExtras',
            'basePrice',
            'extrasPrice',
            'finalPrice',
            'countries',
            'pricingType',
            'requiresQuantity',
            'quantity',
            'unitPrice'
        ));
    }

    //order cancel page
    public function order_payment_cancel_static()
    {
        return view('frontend.pages.order.cancel');
    }

    //confirm order
    public function user_order_confirm(Request $request)
    {
        if(!$request->has('selected_payment_gateway')) {
            return back()->with(toastr_warning(__('Payment gateway not selected. Please try again.')));
        }

        if($request->has('selected_extras') && is_string($request->selected_extras)){
            $request->merge(['selected_extras' => json_decode($request->selected_extras, true)]);
        }

        $request->validate([
            'phone' => 'required|string',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|string',
            'city_id' => 'required|integer',
            'state_id' => 'required|integer',
            'service_address' => 'required|string',
        ]);

        $project = Project::where('id',$request->project_id)->first();
        $job = JobPost::where('id',$request->job_id_for_order)->first();
        $offer = Offer::with('milestones')->where('id',$request->offer_id_for_order)->first();
        $order_type = null;

        if ($project) {
            $base_price = 0;
            $extra_services_price = 0;
            $type = null;
            $revision = null;
            $delivery = null;

            if ($request->basic_standard_premium_type === $project->basic_title) {
                $type = $project->basic_title;
                $revision = $project->basic_revision;
                $delivery = $project->basic_delivery;
                $base_price = ($project->basic_discount_charge !== null && $project->basic_discount_charge > 0)
                    ? $project->basic_discount_charge
                    : $project->basic_regular_charge;

                if ($request->has('selected_extras') && is_array($request->selected_extras)) {
                    foreach ($request->selected_extras as $attr_id) {
                        $attribute = $project->project_attributes->where('id', $attr_id)->first();
                        if ($attribute && $attribute->basic_extra_price > 0) {
                            $extra_services_price += $attribute->basic_extra_price;
                        }
                    }
                }
            }

            if ($request->basic_standard_premium_type === $project->standard_title) {
                $type = $project->standard_title;
                $revision = $project->standard_revision;
                $delivery = $project->standard_delivery;
                $base_price = ($project->standard_discount_charge !== null && $project->standard_discount_charge > 0)
                    ? $project->standard_discount_charge
                    : $project->standard_regular_charge;

                if ($request->has('selected_extras') && is_array($request->selected_extras)) {
                    foreach ($request->selected_extras as $attr_id) {
                        $attribute = $project->project_attributes->where('id', $attr_id)->first();
                        if ($attribute && $attribute->standard_extra_price > 0) {
                            $extra_services_price += $attribute->standard_extra_price;
                        }
                    }
                }
            }

            if ($request->basic_standard_premium_type === $project->premium_title) {
                $type = $project->premium_title;
                $revision = $project->premium_revision;
                $delivery = $project->premium_delivery;
                $base_price = ($project->premium_discount_charge !== null && $project->premium_discount_charge > 0)
                    ? $project->premium_discount_charge
                    : $project->premium_regular_charge;

                if ($request->has('selected_extras') && is_array($request->selected_extras)) {
                    foreach ($request->selected_extras as $attr_id) {
                        $attribute = $project->project_attributes->where('id', $attr_id)->first();
                        if ($attribute && $attribute->premium_extra_price > 0) {
                            $extra_services_price += $attribute->premium_extra_price;
                        }
                    }
                }
            }

            // Yaptiriyo pricing types: m²/saat/adet ilanlarında fiyat sunucuda
            // miktar × birim fiyat olarak hesaplanır (mobil API ile aynı kural).
            $projectPricingType = $project->pricing_type ?? \App\Enums\PricingType::FIXED;
            if (\App\Enums\PricingType::requiresQuantity($projectPricingType)) {
                $quantity = max(0.01, (float) ($request->quantity ?? 1));
                $request->merge(['unit_price' => (float) $base_price, 'quantity' => $quantity]);
                $base_price = round($base_price * $quantity, 2);
            }

            $price = $base_price + $extra_services_price;

            if (moduleExists('CurrencySwitcher')) {
                $price = get_conversion_price($price);
            }

            $project_or_job = 'project';
            $freelancer_id  = $project->user_id;
            $order_type     = $project?->project_creator?->user_type == 1 ? 'freelancer_order' : null;

        } else {
            if($job){
                $proposal = JobProposal::select(['id','freelancer_id','amount','duration','revision'])->where('id',$request->proposal_id_for_order)->first();
                $price = $proposal->amount;
                $type = 'job';
                $revision = $proposal->revision;
                $delivery = $proposal->duration;
                $project_or_job = 'job';
                $freelancer_id = $proposal->freelancer_id;
                $order_type = $job?->job_creator?->user_type == 2 ? 'client_order' : null;
                if(moduleExists('CurrencySwitcher')){
                    $price = get_conversion_price($price);
                }
            }
            if($offer){
                $price = $offer->price;
                $type = 'offer';
                $revision = $offer->revision;
                $delivery = $offer->deadline;
                $project_or_job = 'offer';
                $freelancer_id = $offer->freelancer_id;
                if(moduleExists('CurrencySwitcher')){
                    $price = get_conversion_price($price);
                }
            }
        }

        if(Auth::guard('web')->check()){
            $client_id = auth()->user()->id;
        }

        $commission_type = get_static_option('admin_commission_type') ?? 'percentage';
        $commission_charge = get_static_option('admin_commission_charge') ?? 25;
        $transaction_type = get_static_option('transaction_fee_type');
        $transaction_charge = get_static_option('transaction_fee_charge') ?? 0;

        $user = User::select('id','first_name','last_name','email')->where('id',$freelancer_id)->first();
        $individual_commission = IndividualCommissionSetting::select(['user_id','admin_commission_type','admin_commission_charge'])->where('user_id',$user->id)->first();

        $subscription_commission = get_user_subscription_commission($user->id);
        $commission_amount = commission_amount($price, $individual_commission, $subscription_commission, $commission_type, $commission_charge);
        $transaction_amount = transaction_amount($price, $transaction_type, $transaction_charge);

        $payable_amount = (float)$price - $commission_amount;
        $payment_status = $request->selected_payment_gateway === 'wallet' ? 'complete' : 'pending';

        $pay_by_milestone = $request->pay_by_milestone;
        if(!empty($pay_by_milestone) && $pay_by_milestone === 'pay-by-milestone'){
            $request->validate([
                'milestone_title.*' => 'required|max:100',
                'milestone_description.*' => 'required|max:1000',
                'milestone_price.*' => 'required',
                'milestone_revision.*' => 'required',
                'milestone_deadline.*' => 'required',
            ]);

            $milestone_price = 0;
            foreach($request->milestone_price as $key => $attr) {
                $milestone_price += $request->milestone_price[$key];
            }

            if($milestone_price > $price || $milestone_price < $price){
                return back()->with(toastr_warning(__('Milestone price must be equal to original price')));
            }
        }

        $check_client_order = Order::where('user_id',$client_id)
            ->where('identity',$request->project_id)
            ->where('is_project_job','project')
            ->where('payment_status','complete')
            ->whereIn('status',[0,1,2,3])
            ->first();

        if($check_client_order){
            $statusMessages = [
                0 => __('You have a pending order for this project. Please wait for it to be processed or cancel it first.'),
                1 => __('You have an active order for this project. Please complete it before creating a new order.'),
                2 => __('You have a delivered order for this project waiting for your approval. Please complete or reject it first.'),
                3 => __('You have already completed an order for this project.'),
            ];

            $statusMessage = $statusMessages[$check_client_order->status]
                ?? __('You cannot create one more order until your current order is complete.');

            return back()->with(toastr_warning($statusMessage));
        }

        if(moduleExists('HourlyJob') && !empty($job)){
            if($job->type == 'hourly')
            {
                $wallet_amount = Auth::guard('web')->user()->user_wallet?->balance ?? 0;
                $price = $job->hourly_rate * $job->estimated_hours;
                $commission_amount = commission_amount($price, $individual_commission, $subscription_commission, $commission_type, $commission_charge);
                $payment_status = 'complete';

                $payable_amount = $price - $commission_amount;
                $shortage_amount = $price - $wallet_amount;

                if($price > $wallet_amount){
                    return back()->with(toastr_warning(__('Wallet balance shortage ' .float_amount_with_currency_symbol($shortage_amount). ' based on hourly rate and estimated hours. Please deposit first to place the order.')));
                }
                return (new OrderService())->hourly_order($request, $client_id, $user->id, $project_or_job, $type, $revision, $delivery, $price, $commission_type, $commission_charge, $commission_amount, $transaction_type, $transaction_charge, $payable_amount, $payment_status,$wallet_amount,$order_type);
            }
        }

        $paymentGatewayHelper = new \App\Helper\PaymentGatewayList();
        $all_gateway = $paymentGatewayHelper->listOfPaymentGateways();
        $all_gateway[] = 'wallet';

        if(empty($request->selected_payment_gateway)){
            return back()->with(toastr_warning(__('Please select a payment gateway before place an order')));
        }

        $selectedGateway = $request->selected_payment_gateway;
        $isValidGateway = false;

        if ($selectedGateway === 'wallet') {
            $isValidGateway = true;
        }
        elseif ($selectedGateway === 'manual_payment') {
            $isValidGateway = (bool) get_static_option('manual_payment_gateway');
        }
        elseif (in_array($selectedGateway, $all_gateway)) {
            $gatewayEnabled = get_static_option($selectedGateway . '_gateway');
            if ($gatewayEnabled === 'on') {
                $isValidGateway = true;
            }
        }

        if (!$isValidGateway) {
            return back()->with(toastr_warning(__('Selected payment gateway is not enabled or invalid')));
        }

        if($request->selected_payment_gateway == 'manual_payment')
        {
            $allowedSize = get_static_option('max_upload_size') ?? '5120';
            $allowedExtensions = json_decode(get_static_option('file_extensions'), true);

            if($allowedExtensions){
                $allowed_extensions = implode(',', $allowedExtensions);
                $request->validate([
                    'manual_payment_image' => 'required|mimes:' . $allowed_extensions . '|max:' . $allowedSize,
                ]);
            }else{
                $request->validate(['manual_payment_image' => 'required|mimes:jpg,jpeg,png,pdf']);
            }
            return (new OrderService())->manual_order($request, $client_id, $user->id, $project_or_job, $type, $revision, $delivery, $price, $commission_type, $commission_charge, $commission_amount, $transaction_type, $transaction_charge, $payable_amount, $payment_status,$order_type);
        }
        elseif($request->selected_payment_gateway == 'wallet')
        {
            if(moduleExists('CurrencySwitcher')){
                $get_user_currency = SelectedCurrencyList::where('currency', get_currency_according_to_user())->first() ?? null;
                $wallet_amount = (Auth::guard('web')->user()->user_wallet?->balance ?? 0) * $get_user_currency->conversion_rate;
            }else{
                $wallet_amount = Auth::guard('web')->user()->user_wallet?->balance ?? 0;
            }

            if($price > $wallet_amount){
                return back()->with(toastr_warning(__('Wallet balance must be equal or greater than original price')));
            }

            return (new OrderService())->wallet_order($request, $client_id, $user->id, $project_or_job, $type, $revision, $delivery, $price, $commission_type, $commission_charge, $commission_amount, $transaction_type, $transaction_charge, $payable_amount, $payment_status,$wallet_amount,$order_type);
        }
        else
        {
            return (new OrderService())->digital_payment_gateway_order($request, $client_id, $user->id, $project_or_job, $type, $revision, $delivery, ($price+$transaction_amount), $commission_type, $commission_charge, $commission_amount, $transaction_type, $transaction_charge, $transaction_amount, $payable_amount, $payment_status,$order_type);
        }
    }

    public function user_order_success_page($id)
    {
        if(Auth::guard('web')->check()){
            $order_details = Order::find(substr($id,30,-30));
            return !empty($order_details) && $order_details->user_id == auth()->user()->id  ? view('frontend.pages.order.success',compact('order_details')) : back();
        }
    }

    private function getOrderStatusText($status)
    {
        $statusMap = [
            0 => 'Pending',
            1 => 'Active',
            2 => 'Delivered',
            3 => 'Complete',
            4 => 'Cancelled'
        ];

        return $statusMap[$status] ?? 'Unknown';
    }
}