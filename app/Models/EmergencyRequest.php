<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Service\Entities\Category;

class EmergencyRequest extends Model
{
    protected $fillable = [
        'client_id',
        'title',
        'category_id',
        'city_id',
        'description',
        'address',
        'latitude',
        'longitude',
        'status',
        'accepted_by',
        'offered_price',
        'accepted_at',
        'expires_at',
        'notified_count',
        'freelancer_status',
        'freelancer_lat',
        'freelancer_long',
    ];

    protected $casts = [
        'accepted_at' => 'datetime',
        'expires_at' => 'datetime',
        'offered_price' => 'decimal:2',
    ];

    // ── Relationships ──

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function acceptedFreelancer()
    {
        return $this->belongsTo(User::class, 'accepted_by');
    }

    public function offers()
    {
        return $this->hasMany(EmergencyOffer::class, 'emergency_request_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // ── Scopes ──

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'accepted']);
    }
}
