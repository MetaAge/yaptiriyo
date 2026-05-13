<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reel extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'video',
        'thumbnail',
        'description',
        'views',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(ReelLike::class);
    }

    public function comments()
    {
        return $this->hasMany(ReelComment::class);
    }

    public function getIsLikedAttribute()
    {
        $user_id = auth('sanctum')->id();
        if (!$user_id) return false;
        return $this->likes()->where('user_id', $user_id)->exists();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }
}
