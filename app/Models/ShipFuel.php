<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipFuel extends Model
{
    use HasFactory;

    protected $fillable = [
        'ship_id',
        'capacity',
        'current',
    ];
}
