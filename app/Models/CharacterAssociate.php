<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterAssociate extends Model
{
    use HasFactory;

    protected $fillable = [
        'character_id',
        'type',
        'name',
        'who',
        'how',
    ];
}
