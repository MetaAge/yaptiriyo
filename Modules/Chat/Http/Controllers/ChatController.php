<?php

namespace Modules\Chat\Http\Controllers;

use Cache;
use App\Models\User;
use App\Models\Order;
use App\Mail\BasicMail;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use JetBrains\PhpStorm\NoReturn;
use Illuminate\Routing\Controller;
use App\Helper\BroadcastingHelper;
use Modules\Chat\Entities\LiveChat;
use Illuminate\Support\Facades\Mail;
use Modules\SecurityManage\Entities\Word;
use Modules\Chat\Services\UserChatService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Log;
use Modules\Chat\Http\Requests\MessageSendRequest;
use Modules\Subscription\Entities\UserSubscription;
use Modules\Chat\Http\Requests\FetchChatRecordRequest;

class ChatController extends Controller
{
    public function live_chat()
    {
        $client_chat_list = LiveChat::with("client","freelancer")
            ->whereHas('freelancer')
            ->withCount("client_unseen_msg","freelancer_unseen_msg")
            ->withMax("livechatMessage as last_message_at", "created_at")
            ->where("client_id", auth("web")->id())
            ->orderByDesc('client_unseen_msg_count')
            ->orderByDesc("last_message_at")
            ->get();

        $arr = "";
        foreach($client_chat_list->pluck("freelancer_id") as $id){
            $arr .= "freelancer_id_". $id .": false,";
        }
        $arr = rtrim($arr,",");
        return view("chat::client.index",compact('client_chat_list','arr'));
    }

    public function fetch_chat_record(FetchChatRecordRequest $request){
        $data = $request->validated();
        $data = UserChatService::fetch($data["freelancer_id"],$data["client_id"],from: 1);
        $currentUserType = "freelancer";

        $body = view("chat::client.message-body", compact('data'))->render();
        $header = view("chat::client.message-header", compact('data'))->render();

        return response()->json([
            "body" => $body,
            "header" => $header,
            "allow_load_more" => $data->allow_load_more ?? false,
        ]);
    }

    public function message_send(Request $request){
        $order_details = Order::where('id',$request->order_id ?? 0)->first();

        # check livechat configuration value are exist or not
        // if(empty(env("PUSHER_APP_ID")) && empty(env("PUSHER_APP_KEY")) && empty(env("PUSHER_APP_SECRET")) && empty(env("PUSHER_HOST"))){
        //     return back()->with(toastr_error(__("Please configure your pusher credentials")));
        // }
        if (!BroadcastingHelper::isConfigured()) {
            $driver = BroadcastingHelper::getDriver();
            $message = $driver === 'null'
                ? __("Please configure your broadcasting driver and credentials")
                : __("Please configure your {$driver} credentials");

            return back()->with(toastr_error($message));
        }

        //check for active subscription
        if(!empty(get_static_option('subscription_chat_enable_disable')) && get_static_option('subscription_chat_enable_disable') == 'disable') {

            // Determine role based on current route
            if(request()->is('client/*')) {
                $currentRole = 'client';
            } elseif(request()->is('freelancer/*')) {
                $currentRole = 'freelancer';
            } else {
                $currentRole = Session::get('user_role', 'client');
            }

            // Only apply subscription check when acting as freelancer
            if($currentRole == 'freelancer') {
                $active_subscription = UserSubscription::select(['id','user_id','limit','expire_date','created_at'])
                    ->where('payment_status','complete')
                    ->where('status',1)
                    ->where('user_id',auth()->user()->id)
                    ->where('expire_date', '>', Carbon::now())->count();

                if($active_subscription <= 0){
                    return back()->with(toastr_warning(__('You need an active subscription to send messages. Please purchase subscription.')));
                }
            }
        }

        //prevent restricted word for chat
        if(moduleExists('SecurityManage')) {
            $message = $request->message;
            $restrictedWords = Word::where('status', 'active')->pluck('word')->toArray();

            $matchedWords = array_filter($restrictedWords, function($word) use ($message) {
                return strpos($message, $word) !== false;
            });

            if (count($matchedWords) > 0) {
                return false;
            }
        }

        // Engel kontrolü: engellenen taraflar mesajlaşamaz (mobil API paritesi).
        if (\App\Models\UserBlock::existsBetween(auth('web')->id(), $request->freelancer_id)) {
            return back()->with(toastr_error(__('Bu kullanıcıyla mesajlaşamazsınız.')));
        }

        if($order_details?->is_project_job != 'offer') {

            try {
                //: send message
                $message_send = UserChatService::send(
                    auth('web')->id(),
                    $request->freelancer_id,
                    $request->message, 1,
                    $request->file,
                    (int)($request->project_id ?? $request->job_id),
                    $order_details->is_project_job ?? $request->type,
                    (int)($request->proposal_id ?? 0),
                    $request->interview_message ?? '',
                );

                if (get_static_option('chat_email_enable_disable') == 'enable') {
                    if ($request->freelancer_id) {
                        if (!Cache::has('user_is_online_' . $request->freelancer_id)) {
                            $user = User::select('id', 'email', 'check_online_status')->where('id', $request->freelancer_id)->first();
                            try {
                                Mail::to($user->email)->send(new BasicMail([
                                    'subject' => __('Chat Email'),
                                    'message' => __('You have a new chat message. Please check')
                                ]));
                            } catch (\Exception $e) {
                            }
                        }

                    }
                }

                if ($request->from === 'chatbox') {
                    return response()->json(['success' => true, 'message' => $message_send]);
                }

            } catch (\RuntimeException $e) {
                Log::error("Chat message send failed", [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                if ($request->from === 'chatbox') {
                    return response()->json(['error' => 'Realtime connection failed, please refresh chat'], 500);
                }
                return back()->with(toastr_warning("Realtime connection failed, please refresh chat"));
            }
        }

        return redirect()->route('client.live.chat',[
            'freelancer_id'=>$request->freelancer_id
        ]);
    }
}
