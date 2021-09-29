<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Transaction;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['title', 'desc', 'entry'];

    /**
     * Convert first letter of Title into uppercase
     *
     * @param string $value
     * @return string $Value
     */
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the transaction associated with the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class, 'category_id');
    }

    /**
     * Get the entry for specidic resource
     *
     * @param int $id
     * @return string
     */
    public static function getEntry($id)
    {
        $entry = Category::select('entry')->where('id', $id)->first();
        return $entry->entry;
    }

    /**
     * Get all id form debit entry
     *
     * @return array
     */
    public static function getAllIdHavingDebitEntry()
    {
        return Category::select('id')->where('entry', 'dr')->get();
    }

    /**
     * Get all id form credit entry
     *
     * @return array
     */
    public static function getAllIdHavingCreditEntry()
    {
        return Category::select('id')->where('entry', 'cr')->get();
    }
}
