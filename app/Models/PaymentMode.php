<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Balance, Transaction};
use Illuminate\Database\Eloquent\Relations\{HasOne, HasMany};


class PaymentMode extends Model
{
    use HasFactory;

    protected $table = 'payment_modes';

    protected $fillable = ['title', 'desc', 'is_deletable'];

    /**
     * Get the balance that owns the PaymentMode
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function balance(): HasOne
    {
        return $this->hasOne(Balance::class, 'mode_id');
    }

    /**
     * Get all of the transaction for the PaymentMode
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class, 'mode_id');
    }
}
