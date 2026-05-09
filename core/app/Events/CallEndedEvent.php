<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CallEndedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $callData;
    private int $client_id, $freelancer_id;
    private int $messageFrom;

    public function __construct(array $callData, int $client_id, int $freelancer_id, int $messageFrom)
    {
        $this->callData = $callData;
        $this->client_id = $client_id;
        $this->freelancer_id = $freelancer_id;
        $this->messageFrom = $messageFrom;
    }

    public function broadcastOn(): array
    {
        $targetUserId = ($this->messageFrom == 2) ? $this->client_id : $this->freelancer_id;
        return [
            new PrivateChannel('user-incoming-call.' . $targetUserId)
        ];
    }

    public function broadcastAs(): string
    {
        return 'call-ended';
    }

    public function broadcastWith(): array
    {
        return $this->callData;
    }
}
