<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Friend extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'friend_user_id',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'friend_user_id');
    }

    public function getFriend(): ?User
    {
        return $this->user()->first();
    }

    public function getUserFriends(): array
    {
        $friends = [];
        $user = Auth::user();
        $allFriends = $this->newQuery()
            ->where('user_id', '=', $user->id)
            ->get();
        foreach ($allFriends as $friend) {
            $friends[] = $friend->getFriend();
        }

        return $friends;
    }

    public function getCurrentFriendIds(): array
    {
        $user = Auth::user();
        return $this->newQuery()
            ->where('user_id', '=', $user->id)
            ->pluck('friend_user_id')
            ->toArray();
    }
}
