<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function gameShips(): HasMany
    {
        return $this->hasMany(GameShip::class, 'game_id', 'id');
    }

    public function gameCharacters(): HasMany
    {
        return $this->hasMany(GameCharacter::class, 'game_id', 'id');
    }

    public function gameUsers(): HasMany
    {
        return $this->hasMany(GameUser::class, 'game_id', 'id');
    }

    public function getGM(): GameUser
    {
        return $this->gameUsers()
            ->where('is_gm', '=', true)
            ->first();
    }

    public function getAllUsers(): array
    {
        $users = [];
        $gameUsers = $this->gameUsers()->get();
        foreach ($gameUsers as $gameUser) {
            if ($gameUser->is_gm) {
                $users['gm'] = $gameUser->user()->first();
            } else {
                $users['players'][] = $gameUser->user()->first();
            }
        }

        return $users;
    }
}
