<?php

namespace App\Http\Services\Frontend;

use App\Helper\PaymentGatewayRequestHelper;
use App\Mail\OrderMail;
use App\Models\IndividualCommissionSetting;
use App\Models\JobProposal;
use App\Models\Order;
use App\Models\OrderMilestone;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Modules\Chat\Entities\Offer;
use Modules\Wallet\Entities\Wallet;
use App\Http\Services\Frontend\IyzicoPaymentService;
use Modules\Chat\Services\UserChatService;

class OrderServiceApi
{
    private const CANCEL_ROUTE = 'order.payment.cancel.static';

  //manual order
  public function manual_order($data,$request, $client_id, $freelancer_id, $project_or_job, $type, $revision, $delivery, $price, $commission_type, $commission_charge, $commission_amount, $transaction_type, $transaction_charge, $payable_amount, $payment_status)
  {
      $pay_by_milestone = $request->pay_by_milestone;
      $offer = Offer::with('milestones')->where('id',$request->offer_id_for_order)->first();

      if($request->project_id){ $identity = $request->project_id; }
      if($request->job_id_for_order){ $identity = $request->job_id_for_order; }
      if($request->offer_id_for_order){ $identity = $request->offer_id_for_order; }
      if($request->emergency_id_for_order){ $identity = $request->emergency_id_for_order; }

      if($request->hasFile('manual_payment_image')){
          $manual_payment_image = $request->manual_payment_image;
          $img_ext = $manual_payment_image->extension();
          $manual_payment_image_name = 'manual_attachment_'.time().'.'.$img_ext;

          if(in_array($img_ext,['jpg','jpeg','png','pdf'])){
              $manual_image_path = 'assets/uploads/manual-payment/order';

              if (in_array($img_ext,['jpg','jpeg','png'])) {
                  $resize_full_image = Image::make($request->manual_payment_image);
                  $resize_full_image->save($manual_image_path .'/'. $manual_payment_image_name);
              }else{
                  $manual_payment_image->move($manual_image_path,$manual_payment_image_name);
              }

              $order = Order::create([
                  'user_id' => $client_id,
                  'freelancer_id' => $freelancer_id,
                  'identity' => $identity,
                  'is_project_job' => $project_or_job,
                  'is_basic_standard_premium_custom' => $type,
                  'revision' => $revision,
                  'revision_left' => $revision,
                  'delivery_time' => $delivery,
                  'description' => $request->order_description ?? ($offer->description ?? NULL),
                  'price' => $price,
                  'commission_type' => $commission_type,
                  'commission_charge' => $commission_charge,
                  'commission_amount' => $commission_amount,
                  'transaction_type' => $transaction_type,
                  'transaction_charge' => $transaction_charge,
                  'transaction_amount' => 0,
                  'payable_amount' => $payable_amount,
                  'payment_gateway' => $request->selected_payment_gateway,
                  'payment_status' => $payment_status,
                  'manual_payment_image' => $manual_payment_image_name,
                  'status' => 0,
                  'appointment_date' => $request->appointment_date,
                  'appointment_time' => $request->appointment_time,
                  'service_address' => $request->service_address,
                  'city_id' => $request->city_id,
                  'state_id' => $request->state_id,
                  'phone' => $request->phone,
              ]);
              $last_order_id = $order->id;
              $type_ = 'Order';
              $msg = __('New order placed');
              notificationToAdmin($last_order_id, $client_id, $type_, $msg);
              freelancer_notification($last_order_id, $freelancer_id, $type_, $msg);

              //check and create project order with milestone
              if(!empty($pay_by_milestone) && $pay_by_milestone === 'pay-by-milestone'){
                  self::createMilestone($last_order_id,$request,$data);
              }

              //check and create custom offer order with milestone
              if($project_or_job == 'offer' && $offer?->milestones->count() >= 1){
                  self::createOfferOrderMilestone($last_order_id,$request);
              }

              $client = User::select(['id','email'])->where('id',$client_id)->first();
              $freelancer = User::select(['id','email'])->where('id',$freelancer_id)->first();

              //email to admin
              try {
                  Mail::to(get_static_option('site_global_email'))->send(new OrderMail($last_order_id,'admin'));
              } catch (\Exception $e) {}

              //email to client
              try {
                  Mail::to($client->email)->send(new OrderMail($last_order_id,'client'));
              } catch (\Exception $e) {}

              //email to freelancer
              try {
                  Mail::to($freelancer->email)->send(new OrderMail($last_order_id,'freelancer'));
              } catch (\Exception $e) {}

              //update job proposal (hired 0 to 1) if the order created from job
              if($project_or_job == 'job'){
                  JobProposal::where('id',$request->proposal_id_for_order)->update(['is_hired'=>1]);
              }
              if ($project_or_job == 'emergency') {
                  // Manual payment doesn't complete the emergency until admin approves
                  // But we might want to change status to 'paying' or similar?
                  // For now let's keep it as is, or mark as processing.
              }

              //status 1 means the offer is hired
              if($project_or_job == 'offer'){
                  Offer::where('id',$request->offer_id_for_order)->update(['status'=>1]);
              }

              $this->send_order_chat_message($order);

              $order_details = Order::with(['user','freelancer'])->where('id',$last_order_id)->first();
              return response()->json([
                  'msg'=> __('Order successfully completed.'),
                  'order_details'=> $order_details,
              ]);
          }else{
              return response()->json(['msg'=> __('Image type not supported')]);
          }
      }
  }

  //wallet order
    public function wallet_order($data,$request, $client_id, $freelancer_id, $project_or_job, $type, $revision, $delivery, $price, $commission_type, $commission_charge, $commission_amount, $transaction_type, $transaction_charge, $payable_amount, $payment_status, $wallet_balance)
    {
        $pay_by_milestone = $request->pay_by_milestone;
        $offer = Offer::with('milestones')->where('id',$request->offer_id_for_order)->first();

        if($request->project_id){ $identity = $request->project_id; }
        if($request->job_id_for_order){ $identity = $request->job_id_for_order; }
        if($request->offer_id_for_order){ $identity = $request->offer_id_for_order; }
        if($request->emergency_id_for_order){ $identity = $request->emergency_id_for_order; }

        $order = Order::create([
            'user_id' => $client_id,
            'freelancer_id' => $freelancer_id,
            'identity' => $identity,
            'is_project_job' => $project_or_job,
            'is_basic_standard_premium_custom' => $type,
            'revision' => $revision,
            'revision_left' => $revision,
            'delivery_time' => $delivery,
            'description' => $request->order_description ?? ($offer->description ?? NULL),
            'price' => $price,
            'commission_type' => $commission_type,
            'commission_charge' => $commission_charge,
            'commission_amount' => $commission_amount,
            'transaction_type' => $transaction_type,
            'transaction_charge' => $transaction_charge,
            'transaction_amount' => 0,
            'payable_amount' => $payable_amount,
            'payment_gateway' => $request->selected_payment_gateway,
            'payment_status' => $payment_status,
            'status' => 0,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'service_address' => $request->service_address,
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
            'phone' => $request->phone,
        ]);

        $last_order_id = $order->id;
        $type_ = 'Order';
        $msg = __('New order placed');
        notificationToAdmin($last_order_id, $client_id, $type_, $msg);
        freelancer_notification($last_order_id, $freelancer_id, $type_, $msg);


        //check and create milestone
        if (!empty($pay_by_milestone) && $pay_by_milestone === 'pay-by-milestone') {
            self::createMilestone($last_order_id, $request,$data);
        }

        //check and create custom offer order with milestone
        if($project_or_job == 'offer' && $offer?->milestones->count() >= 1){
            self::createOfferOrderMilestone($last_order_id,$request);
        }

        //status 1 means the offer is hired
        if($project_or_job == 'offer'){
            Offer::where('id',$request->offer_id_for_order)->update(['status'=>1]);
        }

        if (auth('sanctum')->check()){
            $user_type = auth('sanctum')->user()->user_type == 1 ? 'client' : 'freelancer';
            $client_email = auth('sanctum')->user()->email;
            $user_id = $user_type == 'client' ? $client_id : $freelancer_id;
            Wallet::where('user_id',$user_id)->update([
                'balance'=> ($wallet_balance - $price)
            ]);
        }

        $freelancer = User::select(['id','email'])->where('id',$freelancer_id)->first();

        //email to admin
        try {
            Mail::to(get_static_option('site_global_email'))->send(new OrderMail($last_order_id,'admin'));
        } catch (\Exception $e) {}

        //email to client
        try {
            Mail::to($client_email)->send(new OrderMail($last_order_id,'client'));
        } catch (\Exception $e) {}

        //email to freelancer
        try {
            Mail::to($freelancer->email)->send(new OrderMail($last_order_id,'freelancer'));
        } catch (\Exception $e) {}

        //update job proposal (hired 0 to one) if the order created from job
        if($project_or_job == 'job'){
            JobProposal::where('id',$request->proposal_id_for_order)->update(['is_hired'=>1]);
        }
        if ($project_or_job == 'emergency') {
            \App\Models\EmergencyRequest::where('id', $order->identity)->update(['status' => 'completed']);
        }
        $this->send_order_chat_message($order);

        $order_details = Order::with(['user','freelancer'])->where('id',$last_order_id)->first();
        return response()->json([
            'msg'=> __('Order successfully completed.'),
            'order_details'=> $order_details,
        ]);
    }

    // order by payment gateway
    public function digital_payment_gateway_order($data,$request, $client_id, $freelancer_id, $project_or_job, $type, $revision, $delivery, $price, $commission_type, $commission_charge, $commission_amount, $transaction_type, $transaction_charge, $transaction_amount, $payable_amount, $payment_status)
    {
        $pay_by_milestone = $request->pay_by_milestone;
        $offer = Offer::with('milestones')->where('id',$request->offer_id_for_order)->first();

        if($request->project_id){ $identity = $request->project_id; }
        if($request->job_id_for_order){ $identity = $request->job_id_for_order; }
        if($request->offer_id_for_order){ $identity = $request->offer_id_for_order; }
        if($request->emergency_id_for_order){ $identity = $request->emergency_id_for_order; }

        $order = Order::create([
            'user_id' => $client_id,
            'freelancer_id' => $freelancer_id,
            'identity' => $identity,
            'is_project_job' => $project_or_job,
            'is_basic_standard_premium_custom' => $type,
            'revision' => $revision,
            'revision_left' => $revision,
            'delivery_time' => $delivery,
            'description' => $request->order_description ?? ($offer->description ?? NULL),
            'price' => $price,
            'commission_type' => $commission_type,
            'commission_charge' => $commission_charge,
            'commission_amount' => $commission_amount,
            'transaction_type' => $transaction_type,
            'transaction_charge' => $transaction_charge,
            'transaction_amount' => $transaction_amount,
            'payable_amount' => $payable_amount,
            'payment_gateway' => $request->selected_payment_gateway,
            'payment_status' => $payment_status,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'service_address' => $request->service_address,
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
            'phone' => $request->phone,
        ]);

        $last_order_id = $order->id;

        //check and create milestone
        if (!empty($pay_by_milestone) && $pay_by_milestone === 'pay-by-milestone'){
            self::createMilestone($last_order_id, $request,$data);
        }

        //check and create custom offer order with milestone
        if($project_or_job == 'offer' && $offer?->milestones->count() >= 1){
            self::createOfferOrderMilestone($last_order_id,$request);
        }

        if($project_or_job == 'offer'){
            Offer::where('id',$request->offer_id_for_order)->update(['status'=>1]);
        }

        $order_details = Order::with(['user','freelancer'])->where('id',$last_order_id)->first();
        return response()->json([
            'msg'=> __('Order successfully completed.'),
            'order_details'=> $order_details,
        ]);

    }

    //hourly order
    public function hourly_order($request, $client_id, $freelancer_id, $project_or_job, $type, $revision, $delivery, $price, $commission_type, $commission_charge, $commission_amount, $transaction_type, $transaction_charge, $payable_amount, $payment_status, $wallet_balance,$order_type)
    {
        if($request->job_id_for_order){ $identity = $request->job_id_for_order; }

        $order = Order::create([
            'user_id' => $client_id,
            'freelancer_id' => $freelancer_id,
            'identity' => $identity,
            'is_project_job' => $project_or_job,
            'is_basic_standard_premium_custom' => $type,
            'revision' => $revision,
            'revision_left' => $revision,
            'delivery_time' => $delivery,
            'description' => $request->order_description ?? NULL,
            'price' => $price,
            'commission_type' => $commission_type,
            'commission_charge' => $commission_charge,
            'commission_amount' => $commission_amount,
            'transaction_type' => $transaction_type,
            'transaction_charge' => $transaction_charge,
            'transaction_amount' => 0,
            'payable_amount' => $payable_amount,
            'payment_gateway' => 'wallet',
            'payment_status' => $payment_status,
            'status' => 0,
            'is_fixed_hourly' => 'hourly',
            'order_type' => $order_type
        ]);

        $last_order_id = $order->id;
        $type_ = 'Order';
        $msg = __('New order placed');
        notificationToAdmin($last_order_id, $client_id, $type_, $msg);
        freelancer_notification($last_order_id, $freelancer_id, $type_, $msg);

        if (Auth::guard('web')->check()){
            $user_type = Auth::user()->user_type == 1 ? 'client' : 'freelancer';
            $client_email = Auth::user()->email;
            $user_id = $user_type == 'client' ? $client_id : $freelancer_id;
        }

        $freelancer = User::select(['id','email'])->where('id',$freelancer_id)->first();

        //email to admin
        try {
            Mail::to(get_static_option('site_global_email'))->send(new OrderMail($last_order_id,'admin'));
        } catch (\Exception $e) {}

        //email to client
        try {
            Mail::to($client_email)->send(new OrderMail($last_order_id,'client'));
        } catch (\Exception $e) {}

        //email to freelancer
        try {
            Mail::to($freelancer->email)->send(new OrderMail($last_order_id,'freelancer'));
        } catch (\Exception $e) {}

        //update job proposal (hired 0 to one) if the order created from job
        if($project_or_job == 'job'){
            JobProposal::where('id',$request->proposal_id_for_order)->update(['is_hired'=>1]);
        }

        $this->send_order_chat_message($order);

        $order_details = Order::with(['user','freelancer'])->where('id',$last_order_id)->first();
        return response()->json([
            'msg'=> __('Order successfully completed.'),
            'order_details'=> $order_details,
        ]);
    }

    //create project order milestone
    private function createMilestone($last_order_id,$request,$data)
    {
        $commission_type = get_static_option('admin_commission_type') ?? 'percentage';
        $commission_charge = get_static_option('admin_commission_charge') ?? 25;
        $project = Project::where('id',$request->project_id)->first();
        $user = User::select('id','first_name','last_name','email')->where('id',$project->user_id)->first();
        $individual_commission = IndividualCommissionSetting::select(['user_id','admin_commission_type','admin_commission_charge'])->where('user_id',$user->id)->first();

        // get subscription commission
        $subscription_commission = get_user_subscription_commission($user->id);


        $arr = [];
        foreach($data->milestone_title as $key => $attr) {
            $commission_amount = commission_amount($data->milestone_price[$key],$individual_commission,$subscription_commission,$commission_type,$commission_charge);
            
            $arr[] = [
                'order_id' => $last_order_id,
                'title' => $data->milestone_title[$key],
                'description' => $data->milestone_description[$key],
                'price' => $data->milestone_price[$key] - $commission_amount,
                'revision' => $data->milestone_revision[$key],
                'revision_left' => $data->milestone_revision[$key],
                'deadline' => $data->milestone_deadline[$key],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        OrderMilestone::insert($arr);
    }

    //create offer order milestone
    private function createOfferOrderMilestone($last_order_id,$request)
    {
        $commission_type = get_static_option('admin_commission_type') ?? 'percentage';
        $commission_charge = get_static_option('admin_commission_charge') ?? 25;
        $offer = Offer::with('milestones')->where('id',$request->offer_id_for_order)->first();
        $individual_commission = IndividualCommissionSetting::select(['user_id','admin_commission_type','admin_commission_charge'])->where('user_id',$offer->freelancer_id)->first();

        // get subscription commission
        $subscription_commission = get_user_subscription_commission($offer->freelancer_id);

        $arr = [];
        foreach($offer->milestones as $key => $attr) {
            $commission_amount = commission_amount($attr['price'] ,$individual_commission,$subscription_commission,$commission_type,$commission_charge);
            $arr[] = [
                'order_id' => $last_order_id,
                'title' => $attr['title'],
                'description' => $attr['description'],
                'price' => $attr['price'] - $commission_amount,
                'revision' => $attr['revision'],
                'revision_left' => $attr['revision'],
                'deadline' => $attr['deadline'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        OrderMilestone::insert($arr);
    }

    // Iyzico native payment order (3DS flow)
    public function iyzico_native_order($data, $request, $client_id, $freelancer_id, $project_or_job, $type, $revision, $delivery, $price, $commission_type, $commission_charge, $commission_amount, $transaction_type, $transaction_charge, $transaction_amount, $payable_amount, $payment_status, $cardData)
    {
        $pay_by_milestone = $request->pay_by_milestone;
        $offer = Offer::with('milestones')->where('id', $request->offer_id_for_order)->first();

        if ($request->project_id) { $identity = $request->project_id; }
        if ($request->job_id_for_order) { $identity = $request->job_id_for_order; }
        if ($request->offer_id_for_order) { $identity = $request->offer_id_for_order; }
        if ($request->emergency_id_for_order) { $identity = $request->emergency_id_for_order; }

        // Create order with pending payment status
        $order = Order::create([
            'user_id' => $client_id,
            'freelancer_id' => $freelancer_id,
            'identity' => $identity,
            'is_project_job' => $project_or_job,
            'is_basic_standard_premium_custom' => $type,
            'revision' => $revision,
            'revision_left' => $revision,
            'delivery_time' => $delivery,
            'description' => $request->order_description ?? ($offer->description ?? NULL),
            'price' => $price,
            'commission_type' => $commission_type,
            'commission_charge' => $commission_charge,
            'commission_amount' => $commission_amount,
            'transaction_type' => $transaction_type,
            'transaction_charge' => $transaction_charge,
            'transaction_amount' => $transaction_amount,
            'payable_amount' => $payable_amount,
            'payment_gateway' => 'iyzipay',
            'payment_status' => 'pending',
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'service_address' => $request->service_address,
            'city_id' => $request->city_id,
            'state_id' => $request->state_id,
            'phone' => $request->phone,
        ]);

        $last_order_id = $order->id;

        // Create milestones if applicable
        if (!empty($pay_by_milestone) && $pay_by_milestone === 'pay-by-milestone') {
            self::createMilestone($last_order_id, $request, $data);
        }

        // Create offer milestones if applicable
        if ($project_or_job == 'offer' && $offer?->milestones->count() >= 1) {
            self::createOfferOrderMilestone($last_order_id, $request);
        }

        // Mark offer as hired
        if ($project_or_job == 'offer') {
            Offer::where('id', $request->offer_id_for_order)->update(['status' => 1]);
        }

        $user = auth('sanctum')->user();
        $iyzicoService = new IyzicoPaymentService();

        // Build callback URL
        $registerCard = !empty($cardData['register_card']) ? 1 : 0;
        $callbackUrl = url('/api/v1/client/iyzico/3ds-callback-web?order_id=' . $order->id . '&register_card=' . $registerCard);

        // Initialize 3DS
        $threedsResult = $iyzicoService->initialize3DS($order, $user, $cardData, $callbackUrl);

        if ($threedsResult->getStatus() === 'success') {
            return response()->json([
                'status' => 'success',
                'msg' => __('3D Secure verification required'),
                'threeds_html' => $threedsResult->getHtmlContent(),
                'order_id' => $order->id,
                'requires_3ds' => true,
            ]);
        }

        // If 3DS init fails, try non-3DS payment as fallback
        $paymentResult = $iyzicoService->processPayment($order, $user, $cardData);

        if ($paymentResult->getStatus() === 'success') {
            $order->update([
                'payment_status' => 'complete',
                'status' => 0,
                'price' => $price - $transaction_amount,
            ]);

            // Handle card registration if successful and requested
            if (!empty($cardData['register_card']) && !empty($paymentResult->getCardUserKey())) {
                $user->update(['iyzico_card_user_key' => $paymentResult->getCardUserKey()]);
            }

            $client = User::select(['id', 'email'])->where('id', $client_id)->first();
            $freelancer = User::select(['id', 'email'])->where('id', $freelancer_id)->first();

            notificationToAdmin($last_order_id, $client_id, 'Order', __('New order placed'));
            freelancer_notification($last_order_id, $freelancer_id, 'Order', __('You have a new order'));

            try { Mail::to(get_static_option('site_global_email'))->send(new OrderMail($last_order_id, 'admin')); } catch (\Exception $e) {}
            try { Mail::to($client->email)->send(new OrderMail($last_order_id, 'client')); } catch (\Exception $e) {}
            try { Mail::to($freelancer->email)->send(new OrderMail($last_order_id, 'freelancer')); } catch (\Exception $e) {}

            if ($project_or_job == 'job') {
                JobProposal::where('id', $request->proposal_id_for_order)->update(['is_hired' => 1]);
            }

            if ($project_or_job == 'emergency') {
                \App\Models\EmergencyRequest::where('id', $order->identity)->update(['status' => 'completed']);
            }

            $this->send_order_chat_message($order);

            $order_details = Order::with(['user', 'freelancer'])->where('id', $last_order_id)->first();
            return response()->json([
                'status' => 'success',
                'msg' => __('Payment completed successfully'),
                'order_details' => $order_details,
                'requires_3ds' => false,
            ]);
        }

        // Both 3DS and non-3DS failed — delete the order
        Order::where('id', $last_order_id)->delete();
        OrderMilestone::where('order_id', $last_order_id)->delete();

        return response()->json([
            'status' => 'error',
            'msg' => $paymentResult->getErrorMessage() ?? __('Payment failed'),
        ], 422);
    }

    public function send_order_chat_message($order)
    {
        try {
            $message = __('I have placed an order. Order ID: #') . $order->id;
            
            $project_id = null;
            $type = 'project';
            
            if ($order->is_project_job == 'project') {
                $project_id = $order->identity;
                $type = 'project';
            } elseif ($order->is_project_job == 'job') {
                $project_id = $order->identity;
                $type = 'job';
            } elseif ($order->is_project_job == 'offer') {
                $project_id = $order->identity;
                $type = 'offer';
            } elseif ($order->is_project_job == 'emergency') {
                $project_id = $order->identity;
                $type = 'emergency';
            }

            UserChatService::send(
                $order->user_id,
                $order->freelancer_id,
                "Bir sipariş verdim. Sipariş ID: #{$order->id}",
                1, // from_user = 1 (Client)
                null,
                $project_id,
                $type,
                null,
                null,
                'html',
                $order->id
            );
        } catch (\Exception $e) {
            \Log::error("Failed to send order chat message: " . $e->getMessage());
        }
    }
}
