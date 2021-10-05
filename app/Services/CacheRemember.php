<?php
//phpcs:ignoreFile
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Models\{Budget, Category, PaymentOption};

//----------------------- Cacheing is currently under revision --------------------------//
class CacheRemember
{
    /**
     * Cache remember constant in seconds 
     * 6 hours
     */
    private const __SECONDS = 6 * 60 * 60;

    /**
     * Invokes all of the sibling methods
     */
    public function cacheAll()
    {
        $this->cacheBudget();
        $this->cacheCategory();
        $this->cacheOption();
    }

    /**
     * Remeber budgets 
     *
     * @return array
     */
    public function cacheBudget()
    {
        if (Cache::has('budget')) {
            Cache::forget('budget');
        }
        Cache::remember('budget', $this::__SECONDS, function () {
            return Budget::all();
        });
    }

    /**
     * Remeber categories 
     *
     * @return array
     */
    public function cacheCategory()
    {
        if (Cache::has('category')) {
            Cache::forget('category');
        }
        Cache::remember('category', $this::__SECONDS, function () {
            return Category::all();
        });
    }

    /**
     * Remeber payment modes 
     *
     * @return array
     */
    public function cacheOption()
    {
        if (Cache::has('option')) {
            Cache::forget('option');
        }
        Cache::remember('option', $this::__SECONDS, function () {
            return PaymentOption::all();
        });
    }

    /**
     * Retrun the cache for specific resource
     *
     * @param string $key
     * @return array
     */
    public function getCache($key)
    {
        if (Cache::has($key)) {
            return Cache::get($key);
        }
        $functionName = "cache" . Str::ucfirst($key);
        $this->$functionName();
        return Cache::get($key);
    }
}
