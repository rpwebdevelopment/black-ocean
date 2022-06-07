<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GameCharacter extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'character_id',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function character(): HasOne
    {
        return $this->hasOne(Character::class, 'character_id', 'id');
    }
}
