<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentOption extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'payment_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'desc', 'balance', 'is_deletable'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = ['is_deletable' => 1];

    /**
     * Get the payment option's title.
     *
     * @param  string  $value
     * @return string
     */
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the payment option's description.
     *
     * @param  string  $value
     * @return string
     */
    public function getDescAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get all of the transaction for the PaymentOption
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class, 'id', 'option_id');
    }
}
