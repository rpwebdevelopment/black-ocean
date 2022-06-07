<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Collection;

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

    public function ships(): HasManyThrough
    {
        return $this->hasManyThrough(Ship::class, GameShip::class, 'game_id', 'id', 'id', 'ship_id');
    }

    public function gameCharacters(): HasMany
    {
        return $this->hasMany(GameCharacter::class, 'game_id', 'id');
    }

    public function characters(): HasManyThrough
    {
        return $this->hasManyThrough(Character::class, GameCharacter::class, 'game_id', 'id', 'id', 'character_id');
    }

    public function gameUsers(): HasMany
    {
        return $this->hasMany(GameUser::class, 'game_id', 'id');
    }

    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, GameUser::class, 'game_id', 'id', 'id', 'user_id');
    }

    public function getGM(): User
    {
        return $this->users()
            ->where('is_gm', '=', true)
            ->first();
    }

    public function getPlayers(): ?Collection
    {
        return $this->users()
            ->where('is_gm', '=', false)
            ->get();
    }

    public function playerIdArray(): array
    {
        return $this->users()
            ->where('is_gm', '=', false)
            ->pluck('user_id')
            ->toArray();
    }

    public function getAllUsers(): array
    {
        return [
            'gm' => $this->getGM(),
            'players' => $this->getPlayers(),
        ];
    }
}
