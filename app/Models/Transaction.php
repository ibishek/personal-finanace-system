<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\{Budget, Category, PaymentOption};

class Transaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'desc',
        'budget_id',
        'option_id',
        'category_id',
        'amount',
    ];

    /**
     * Get the transaction's title.
     * 
     * @param  string  $value
     * @return string
     */
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the transaction's description.
     *
     * @param  string  $value
     * @return string
     */
    public function getDescAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the budget that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    /**
     * Get the paymentMode that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentOption(): BelongsTo
    {
        return $this->belongsTo(PaymentOption::class, 'option_id', 'id')
            ->withDefault([
                'title' => '-'
            ]);
    }

    /**
     * Get the category that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
