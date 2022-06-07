<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ship extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function details(): hasOne
    {
        return $this->hasOne(ShipDetail::class, 'ship_id', 'id');
    }

    public function expenses(): hasMany
    {
        return $this->hasMany(Expense::class, 'ship_id', 'id');
    }

    public function mortgage(): hasOne
    {
        return $this->hasOne(Mortgage::class, 'ship_id', 'id');
    }

    public function fund(): hasOne
    {
        return $this->hasOne(ShipFund::class, 'ship_id', 'id');
    }

    public function berths(): hasMany
    {
        return $this->hasMany(ShipBerth::class, 'ship_id', 'id');
    }

    public function location(): hasOne
    {
        return $this->hasOne(ShipLoc::class, 'ship_id', 'id');
    }
}
