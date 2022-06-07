<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'home_lat',
        'home_long',
        'credits',
        'ship_shares',
        're_rolls',
        'role',
        'base_toughness',
    ];

    public function characterAttributes(): HasMany
    {
        return $this->hasMany(CharacterAttribute::class, 'character_id', 'id');
    }

    public function associates(): HasMany
    {
        return $this->hasMany(CharacterAssociate::class, 'character_id', 'id');
    }
}
