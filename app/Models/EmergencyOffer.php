<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'emergency_request_id',
        'freelancer_id',
        'offered_price',
        'status',
    ];

    public function emergencyRequest()
    {
        return $this->belongsTo(EmergencyRequest::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }
}
