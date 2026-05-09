<?php

namespace Modules\SupportTicket\Entities;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'message',
        'attachment',
        'notify',
        'type',
        'sender_id',
        'load_from',
        'is_synced'
    ];

    protected static function newFactory()
    {
        return \Modules\SupportTicket\Database\factories\ChatMessageFactory::new();
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function admin_sender()
    {
        return $this->belongsTo(Admin::class, 'sender_id', 'id');
    }

    public function user_sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function getAdminSenderOrDefaultAttribute()
    {
        // if type is admin
        if ($this->type === 'admin') {
            return $this->admin_sender ?? Admin::first();
        }

        return null;
    }
}
