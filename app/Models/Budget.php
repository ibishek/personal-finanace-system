<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Transaction;

class Budget extends Model
{
    use HasFactory;

    protected $table = 'budgets';

    protected $dates = ['expiry_date'];

    protected $fillable = [
        'title',
        'desc',
        'alloted_amount',
        'balance_amount',
        'expiry_date',
        'is_active',
    ];

    /**
     * Get all of the transaction for the Budget
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class, 'budget_id');
    }

    /**
     * Get currently active budget id
     *
     * @return int id
     */
    public static function getCurrentBudgetId()
    {
        $budget = Budget::where('is_active', 1)->first();
        if (!$budget) {
            $budget = Budget::latest()->first();
        }
        return $budget->id;
    }
}
