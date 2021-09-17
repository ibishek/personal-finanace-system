<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $table = 'budgets';

    protected $fillable = [
        'title',
        'desc',
        'alloted_amount',
        'balance_amount',
        'expiry_date',
        'is_active',
    ];
}
