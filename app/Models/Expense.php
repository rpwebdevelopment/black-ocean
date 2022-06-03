<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Expense extends Model
{
    use HasFactory;

    public function type(): hasOne
    {
        return $this->hasOne(ExpenseType::class, 'id', 'expense_type_id');
    }

    public function ship(): belongsTo
    {
        return $this->belongsTo(Ship::class);
    }
}
