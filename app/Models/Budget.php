<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Transaction;

class Budget extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'budgets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'desc',
        'alloted_amount',
        'balance_amount',
        'expiry_date',
        'is_active',
    ];

    /**
     * The attribute that is treated as date object.
     *
     * @var array
     */
    protected $dates = ['expiry_date'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = ['is_active' => 0];

    /**
     * Get the budget's title.
     *
     * @param  string  $value
     * @return string
     */
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the budget's description.
     *
     * @param  string  $value
     * @return string
     */
    public function getDescAttribute($value)
    {
        return ucfirst($value);
    }

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
        $budgetId = Budget::where('is_active', 1)->first('id');
        if (!$budgetId) {
            $budgetId = Budget::latest()->first('id');
        }
        return $budgetId;
    }

    /**
     * Get currently active budget id
     *
     * @return int id
     */
    public static function getExactCurrentBudgetId()
    {
        $budgetId = Budget::where('is_active', 1)->first('id');
        if (!$budgetId) {
            $budgetId = Budget::latest()->first('id');
        }
        return $budgetId->id;
    }
}
