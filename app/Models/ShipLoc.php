<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipLoc extends Model
{
    use HasFactory;

    protected $fillable = [
        'ship_id',
        'current_lat',
        'current_long',
    ];
}
