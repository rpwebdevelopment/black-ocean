<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GameShip extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'ship_id',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function ship(): HasOne
    {
        return $this->hasOne(Ship::class, 'id', 'ship_id');
    }
}
