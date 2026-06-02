<?php

namespace Modules\Chat\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Http;
use Modules\User\Entities\User;
use Modules\Vendor\Entities\Vendor;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class LiveChatMessage extends Model
{
    protected $fillable = [
        "live_chat_id",
        "from_user",
        "message",
        "file",
        'load_from',
        'is_synced'
    ];

    protected $casts = [
        "message" => "json",
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "is_seen" => "integer"
    ];

    public function liveChat(): BelongsTo
    {
        return $this->belongsTo(LiveChat::class,"live_chat_id","id");
    }

    public function client(): HasManyThrough
    {
        return $this->hasManyThrough(User::class,LiveChat::class,'live_chat_id','id','id','client_id');
    }

    public function freelancer(): HasManyThrough
    {
        return $this->hasManyThrough(User::class,LiveChat::class,'live_chat_id','id','id','freelancer_id');
    }

    //: this method will be return file path
    public function getFilePathAttribute(){
        return $this->file;
    }

    protected static function boot(): void
    {
        parent::boot();

        static::created(function ($modal){
            // first check who is the sender of this message if this is a client, then send notification to the freelancer
            // get user from the message

            $freelancer = $modal->liveChat->freelancer;
            $user = $modal->liveChat->client;

            $notificationBody = [
                'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
                'title' => $modal->from_user == 1 ? $user->first_name : $freelancer->first_name,
                'id' => (string) $modal->id,  // Convert to string
                'body' => is_array($modal->message) ? json_encode($modal->message) : (string) $modal->message, // Convert message to string
                'file' => $modal->file ? (string) $modal->file : '',  // Convert file to string if exists
                'description' => '',
                'type' => 'message',
                'sound' => 'default',
                'fcm_device' => '',
                'livechat' => json_encode($modal->liveChat),  // Convert livechat object/array to string
            ];

            try {
                if($modal->from_user){
                    $credentialsPath = storage_path('app/firebase/firebase_credentials.json');
                    if (!file_exists($credentialsPath)) {
                        \Illuminate\Support\Facades\Log::error("LiveChatMessage Notification: Credentials not found");
                        return;
                    }

                    $factory = (new Factory)->withServiceAccount($credentialsPath);
                    $messaging = $factory->createMessaging();

                    $targetUser = $modal->from_user == 1 ? $freelancer : $user;
                    $tokens = $targetUser->firebase_device_token;
                    
                    if (empty($tokens)) return;

                    $tokens = is_array($tokens) ? $tokens : [$tokens];
                    $tokens = array_filter($tokens); // Remove empty values

                    if (empty($tokens)) return;

                    $message = CloudMessage::new()
                        ->withData($notificationBody);

                    foreach ($tokens as $token) {
                        try {
                            $targetMessage = $message->withChangedTarget('token', $token);
                            $messaging->send($targetMessage);
                        } catch (\Exception $e) {
                            \Illuminate\Support\Facades\Log::error("LiveChatMessage Notification Error for token $token: " . $e->getMessage());
                        }
                    }
                }
            }catch (\Exception $e){
                \Illuminate\Support\Facades\Log::error("LiveChatMessage Notification Global Error: " . $e->getMessage());
            }
        });
    }
}
