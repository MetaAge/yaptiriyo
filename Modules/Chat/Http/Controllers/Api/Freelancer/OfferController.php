<?php

namespace Modules\Chat\Http\Controllers\Api\Freelancer;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Chat\Entities\Offer;
use Modules\Chat\Entities\OfferMilestone;

use App\Models\Order;
use App\Models\Rating;
use Modules\Chat\Services\UserChatService;
use Modules\Subscription\Services\PlanGate;

class OfferController extends Controller
{
    public function offer_details($id)
    {
        $user_id = auth('sanctum')->user()->id;
        $offer_details = Offer::with(['milestones', 'client:id,first_name,last_name,image,country_id,state_id,load_from'])
            ->where('freelancer_id', $user_id)->where('id', $id)->first();

        if (!$offer_details) {
            return response()->json(['msg' => __('no offer found.')])->setStatusCode(404);
        }

        $offer_order = Order::where('identity', $offer_details->id)->where('is_project_job', 'offer')->where('payment_status', 'complete')->first();
        $accept_or_pending = !empty($offer_order) ? 1 : 0;

        if ($offer_details?->client?->image) {
            $offer_details->client->client_cloud_image = render_frontend_cloud_image_if_module_exists('profile/' . $offer_details?->client?->image, load_from: $offer_details?->client?->load_from);
        } else {
            $offer_details->client->client_cloud_image = null;
        }

        return response()->json([
            'offer_details' => $offer_details,
            'client_country' => $offer_details?->client?->user_country?->country,
            'client_state' => $offer_details?->client?->user_state?->state,
            'accept_or_pending' => $accept_or_pending,
            'client_image_path' => asset('assets/uploads/profile/'),
            'storage_driver' => \Illuminate\Support\Facades\Storage::getDefaultDriver() ?? '',
        ]);
    }

    public function offer_send(Request $request)
    {
        if(auth('sanctum')->user()->is_suspend == 1){
            return response()->json([
                'msg' => __('You can not send offer because your account is suspended. please try to contact admin.')
            ])->setStatusCode(422);
        }

        // Subscription gate: enforce the monthly offer quota for the current plan.
        $gate = PlanGate::for(auth('sanctum')->user()->id);
        if (!$gate->consume('monthly_offer_limit')) {
            return PlanGate::denied(
                'monthly_offer_limit',
                __('Aylık teklif hakkınız doldu. Daha fazla teklif göndermek için paketinizi yükseltin.')
            );
        }

        $pay_by_milestone = $request->pay_by_milestone;
        $pay_at_once = $request->pay_at_once;

        if(!empty($pay_at_once) && $pay_at_once === 'pay-at-once') {
            $request->validate([
                'offer_description' => 'nullable|max:100000',
                'offer_deadline' => 'required',
                'offer_revision' => 'required|min:1|max:100',
                'client_id' => 'required',
            ]);
        }

        $offer = Offer::create([
            'freelancer_id' => auth('sanctum')->user()->id,
            'client_id' => $request->client_id,
            'price' => $request->offer_price,
            'description' => $request->offer_description ?? NULL,
            'deadline' => $request->offer_deadline ?? NULL,
            'revision' => $request->offer_revision ?? 0,
            'revision_left' => $request->offer_revision ?? 0,
            'status' => 0,
        ]);

        $last_offer_id = $offer->id;
        $type = 'Offer';
        $msg = __('You have a new offer');
        client_notification($last_offer_id, $request->client_id, $type, $msg);

        //check and create milestone
        $data=[];
        if(!empty($pay_by_milestone) && $pay_by_milestone === 'pay-by-milestone'){
            $requestData= [];
            foreach(json_decode($request->milestones,true) as $milestone){
                $requestData["milestone_title"][] = $milestone['milestone_title'];
                $requestData["milestone_description"][] = $milestone['milestone_description'];
                $requestData["milestone_price"][] = $milestone['milestone_price'];
                $requestData["milestone_revision"][] = $milestone['milestone_revision'];
                $requestData["milestone_deadline"][] = $milestone['milestone_deadline'];
            }

            $data = (object) Validator::make($requestData, [
                'milestone_title.*' => 'required|max:100',
                'milestone_description.*' => 'required|max:1000',
                'milestone_price.*' => 'required',
                'milestone_revision.*' => 'required',
                'milestone_deadline.*' => 'required',
            ])->validated();

            $milestone_price = 0;
            foreach($data->milestone_price as $key => $attr) {$milestone_price += $data->milestone_price[$key];}
            if($milestone_price > $request->offer_price || $milestone_price < $request->offer_price){
                return response()->json([
                    "msg" => __('Total milestone price must be equal to offer price')
                ])->setStatusCode(422);
            }

            self::createMilestone($last_offer_id,$request,$data);
        }

        try {
            UserChatService::send(
                $offer->client_id,
                $offer->freelancer_id,
                "Yeni bir teklif gönderdim. Teklif ID: #{$offer->id}",
                2, // from_user = 2 (Freelancer)
                null,
                null,
                null,
                null,
                null,
                'html',
                null,
                $offer->id
            );
        } catch (\Exception $e) {
            \Log::error("Failed to send custom offer chat message: " . $e->getMessage());
        }

        return response()->json([
            'msg' => __('Offer Successfully Send')
        ]);

    }

    private function createMilestone($last_offer_id,$request,$data)
    {
        $arr = [];
        foreach($data->milestone_title as $key => $attr) {
            $arr[] = [
                'offer_id' => $last_offer_id,
                'title' => $data->milestone_title[$key],
                'description' => $data->milestone_description[$key],
                'price' => $data->milestone_price[$key],
                'revision' => $data->milestone_revision[$key],
                'revision_left' => $data->milestone_revision[$key],
                'deadline' => $data->milestone_deadline[$key],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        OfferMilestone::insert($arr);
    }
}
