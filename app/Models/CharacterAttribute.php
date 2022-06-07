<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CharacterAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id',
        'attribute_id',
        'level',
    ];

    public function details(): HasOne
    {
        return $this->hasOne(Attribute::class, 'id', 'attribute_id');
    }
}
