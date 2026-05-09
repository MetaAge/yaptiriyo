<?php

namespace App\Http\Controllers\Api;

use App\Models\CallHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Services\Agora\RtcTokenBuilder2;
use App\Events\IncomingCallEvent;
use App\Events\CallEndedEvent;
use Modules\Chat\Entities\LiveChat;
use Illuminate\Support\Facades\Log;

class AgoraController extends Controller
{
    /**
     * Generate Agora RTC token for voice calling
     */
    public function generateToken(Request $request)
    {
        $request->validate([
            'channel_name' => 'required|string',
            'uid' => 'required|integer',
        ]);

        $appId = env('AGORA_APP_ID');
        $appCertificate = env('AGORA_APP_CERTIFICATE');
        $channelName = $request->input('channel_name');
        $uid = $request->input('uid');
        $role = RtcTokenBuilder2::ROLE_PUBLISHER;
        $tokenExpire = 3600;
        $privilegeExpire = 3600;

        $token = RtcTokenBuilder2::buildTokenWithUid(
            $appId,
            $appCertificate,
            $channelName,
            $uid,
            $role,
            $tokenExpire,
            $privilegeExpire
        );

        return response()->json([
            'token' => $token,
            'channel_name' => $channelName,
            'uid' => $uid,
            'app_id' => $appId,
        ]);
    }

    /**
     * Initiate a voice call — creates call history record and broadcasts event via Pusher
     */
    public function initiateCall(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|integer',
            'live_chat_id' => 'nullable|integer',
        ]);

        $callerId = auth('sanctum')->id();
        $receiverId = $request->input('receiver_id');
        $liveChatId = $request->input('live_chat_id');

        // Generate a unique channel name
        $channelName = 'call_' . min($callerId, $receiverId) . '_' . max($callerId, $receiverId) . '_' . time();

        // Create call history record
        $callHistory = CallHistory::create([
            'caller_id' => $callerId,
            'receiver_id' => $receiverId,
            'live_chat_id' => $liveChatId,
            'channel_name' => $channelName,
            'status' => 'missed',
            'started_at' => now(),
        ]);

        // Generate tokens
        $appId = env('AGORA_APP_ID');
        $appCertificate = env('AGORA_APP_CERTIFICATE');

        $callerToken = RtcTokenBuilder2::buildTokenWithUid(
            $appId, $appCertificate, $channelName, $callerId, RtcTokenBuilder2::ROLE_PUBLISHER, 3600, 3600
        );

        // Get caller info
        $caller = auth('sanctum')->user();

        // Determine who is client and who is freelancer for Pusher channel routing
        $livechat = LiveChat::where(function($q) use ($callerId, $receiverId) {
            $q->where('client_id', $callerId)->where('freelancer_id', $receiverId);
        })->orWhere(function($q) use ($callerId, $receiverId) {
            $q->where('client_id', $receiverId)->where('freelancer_id', $callerId);
        })->first();

        if ($livechat) {
            // Determine messageFrom: 1=client, 2=freelancer
            $messageFrom = ($callerId == $livechat->freelancer_id) ? 2 : 1;

            Log::info("AgoraController: Sending Pusher event for Call " . $callHistory->id);
            // Broadcast incoming call to the receiver via Pusher
            event(new IncomingCallEvent(
                [
                    'type' => 'incoming_call',
                    'call_id' => $callHistory->id,
                    'channel_name' => $channelName,
                    'app_id' => $appId,
                    'caller_id' => $callerId,
                    'caller_name' => $caller->first_name . ' ' . $caller->last_name,
                    'caller_image' => $caller->image ? asset('assets/uploads/profile/' . $caller->image) : null,
                ],
                $livechat->client_id,
                $livechat->freelancer_id,
                $messageFrom
            ));

            Log::info("AgoraController: Sending FCM notification to User " . $receiverId);
            // Send FCM notification for background/closed app support
            send_voice_call_notification($receiverId, [
                'type' => 'incoming_call',
                'call_id' => $callHistory->id,
                'channel_name' => $channelName,
                'app_id' => $appId,
                'caller_id' => $callerId,
                'caller_name' => $caller->first_name . ' ' . $caller->last_name,
                'caller_image' => $caller->image ? asset('assets/uploads/profile/' . $caller->image) : null,
                'live_chat_id' => $liveChatId,
                'livechat' => json_encode($livechat),
                'title' => 'Gelen Sesli Arama',
                'body' => $caller->first_name . ' ' . $caller->last_name . ' sizi arıyor...',
            ]);
        }

        return response()->json([
            'call_id' => $callHistory->id,
            'channel_name' => $channelName,
            'token' => $callerToken,
            'app_id' => $appId,
            'caller_id' => $callerId,
            'caller_name' => $caller->first_name . ' ' . $caller->last_name,
            'caller_image' => $caller->image,
            'receiver_id' => $receiverId,
        ]);
    }

    /**
     * Accept an incoming call — generates token for receiver
     */
    public function acceptCall(Request $request)
    {
        $request->validate([
            'call_id' => 'required|integer',
            'channel_name' => 'required|string',
        ]);

        $userId = auth('sanctum')->id();
        $callHistory = CallHistory::find($request->input('call_id'));

        if ($callHistory) {
            $callHistory->update([
                'status' => 'answered',
                'started_at' => now(),
            ]);
        }

        $appId = env('AGORA_APP_ID');
        $appCertificate = env('AGORA_APP_CERTIFICATE');

        $token = RtcTokenBuilder2::buildTokenWithUid(
            $appId, $appCertificate, $request->input('channel_name'), $userId, RtcTokenBuilder2::ROLE_PUBLISHER, 3600, 3600
        );

        return response()->json([
            'token' => $token,
            'channel_name' => $request->input('channel_name'),
            'app_id' => $appId,
            'uid' => $userId,
        ]);
    }

    /**
     * End a call — updates call history
     */
    public function endCall(Request $request)
    {
        $request->validate([
            'call_id' => 'required|integer',
        ]);

        $callHistory = CallHistory::find($request->input('call_id'));

        if ($callHistory) {
            $endedAt = now();
            $duration = $callHistory->started_at
                ? $endedAt->diffInSeconds($callHistory->started_at)
                : 0;

            $callHistory->update([
                'status' => $callHistory->status === 'answered' ? 'ended' : $callHistory->status,
                'ended_at' => $endedAt,
                'duration' => $duration,
            ]);

            $callerId = auth('sanctum')->id();
            $receiverId = ($callerId == $callHistory->caller_id) ? $callHistory->receiver_id : $callHistory->caller_id;

            $livechat = LiveChat::where(function($q) use ($callerId, $receiverId) {
                $q->where('client_id', $callerId)->where('freelancer_id', $receiverId);
            })->orWhere(function($q) use ($callerId, $receiverId) {
                $q->where('client_id', $receiverId)->where('freelancer_id', $callerId);
            })->first();

            if ($livechat) {
                $messageFrom = ($callerId == $livechat->freelancer_id) ? 2 : 1;
                event(new CallEndedEvent(
                    [
                        'type' => 'call_ended',
                        'call_id' => $callHistory->id,
                    ],
                    $livechat->client_id,
                    $livechat->freelancer_id,
                    $messageFrom
                ));

                // Send FCM to notify background app that call has ended
                send_voice_call_notification($receiverId, [
                    'type' => 'call_ended',
                    'call_id' => $callHistory->id,
                ]);
            }
        }

        return response()->json(['msg' => 'Call ended']);
    }

    /**
     * Decline a call
     */
    public function declineCall(Request $request)
    {
        $request->validate([
            'call_id' => 'required|integer',
        ]);

        $callHistory = CallHistory::find($request->input('call_id'));

        if ($callHistory) {
            $callHistory->update([
                'status' => 'declined',
                'ended_at' => now(),
            ]);

            $callerId = auth('sanctum')->id();
            $receiverId = ($callerId == $callHistory->caller_id) ? $callHistory->receiver_id : $callHistory->caller_id;

            $livechat = LiveChat::where(function($q) use ($callerId, $receiverId) {
                $q->where('client_id', $callerId)->where('freelancer_id', $receiverId);
            })->orWhere(function($q) use ($callerId, $receiverId) {
                $q->where('client_id', $receiverId)->where('freelancer_id', $callerId);
            })->first();

            if ($livechat) {
                $messageFrom = ($callerId == $livechat->freelancer_id) ? 2 : 1;
                event(new CallEndedEvent(
                    [
                        'type' => 'call_ended',
                        'call_id' => $callHistory->id,
                    ],
                    $livechat->client_id,
                    $livechat->freelancer_id,
                    $messageFrom
                ));

                // Send FCM to notify background app that call has ended/declined
                send_voice_call_notification($receiverId, [
                    'type' => 'call_ended',
                    'call_id' => $callHistory->id,
                ]);
            }
        }

        return response()->json(['msg' => 'Call declined']);
    }

    /**
     * Get call history for the authenticated user
     */
    public function callHistory()
    {
        $userId = auth('sanctum')->id();

        $history = CallHistory::where('caller_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['caller:id,first_name,last_name,image', 'receiver:id,first_name,last_name,image'])
            ->orderByDesc('created_at')
            ->paginate(20);

        return response()->json([
            'call_history' => $history,
        ]);
    }
}
