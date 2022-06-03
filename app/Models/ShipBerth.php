<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipBerth extends Model
{
    use HasFactory;

    protected $fillable = [
        'ship_id',
        'name',
        'max',
        'per_parsec_income',
    ];
}
