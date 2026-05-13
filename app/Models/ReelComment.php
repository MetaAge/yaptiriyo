<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReelComment extends Model
{
    use HasFactory;
    protected $fillable = ['reel_id', 'user_id', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
