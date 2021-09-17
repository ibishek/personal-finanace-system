<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $table = 'reminders';

    protected $fillable = [
        'title',
        'desc',
        'amount',
        'types_id',
        'payment_date',
        'alert_before'
    ];
}
