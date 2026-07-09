<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBlock extends Model
{
    protected $fillable = ['blocker_id', 'blocked_id'];

    /**
     * True if $userA and $userB have blocked each other in either direction.
     */
    public static function existsBetween($userA, $userB): bool
    {
        return self::where(function ($q) use ($userA, $userB) {
            $q->where('blocker_id', $userA)->where('blocked_id', $userB);
        })->orWhere(function ($q) use ($userA, $userB) {
            $q->where('blocker_id', $userB)->where('blocked_id', $userA);
        })->exists();
    }
}
