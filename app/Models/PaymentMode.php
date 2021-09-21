<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Balance;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentMode extends Model
{
    use HasFactory;

    protected $table = 'payment_modes';

    protected $fillable = ['title', 'desc', 'is_deletable'];

    /**
     * Get the balance that owns the PaymentMode
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function balance(): BelongsTo
    {
        return $this->belongsTo(Balance::class, 'mode_id');
    }
}
