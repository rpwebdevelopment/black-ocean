<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'ship_id',
        'fuel_consumption_weekly',
        'fuel_consumption_parsec',
        'hardpoints',
        'cargo_volume',
    ];
}
