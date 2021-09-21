<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['title', 'desc', 'entry'];

    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }
}
