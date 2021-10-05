<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Transaction;

class Category extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'desc', 'entry', 'is_deletable'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = ['is_deletable' => 1];

    /**
     * Get the category's title.
     *
     * @param  string  $value
     * @return string
     */
    public function getTitleAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the category's description.
     *
     * @param  string  $value
     * @return string
     */
    public function getDescAttribute($value)
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
        $getEntry = Category::where('id', $id)->first('entry');
        return $getEntry->entry;
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
