<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function friendRequests(): HasMany
    {
        return $this->hasMany(FriendRequest::class, 'for_user_id', 'id');
    }

    public function activeFriendRequests(): HasMany
    {
        return $this->friendRequests()
            ->where('accepted', '=', false)
            ->where('rejected', '=', false);
    }

    public function friends(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Friend::class, 'user_id', 'id', 'id', 'friend_user_id');
    }

    public function games(): HasMany
    {
        return $this->hasMany(GameUser::class, 'user_id', 'id');
    }

    public function friendIdArray(): array
    {
        return $this->friends()
            ->pluck('friend_user_id')
            ->toArray();
    }
}
