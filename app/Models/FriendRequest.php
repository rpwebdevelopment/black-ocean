<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FriendRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'requested_by_user_id',
        'for_user_id',
        'accepted',
        'rejected',
    ];

    public function requested(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'requested_by_user_id');
    }

    public function getRequestedName(): string
    {
        return $this->requested()->first()->username;
    }
}
