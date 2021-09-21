<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Services\UnmaskAmount;
use App\Models\Balance;

class AddBalance
{
    public function __construct()
    {
        $this->unmask = new UnmaskAmount();
    }

    public function saveBalance($amount, $condition, $id)
    {
        $unmaskedAmount = $this->unmask->unmask($amount);

        try {
            $decryptedCondition = Crypt::decrypt($condition);
        } catch (DecryptException $e) {
            return false;
        }

        $balance = Balance::findOrFail($id);

        if ($decryptedCondition == 'incre') {
            $balance->increment('amount', $unmaskedAmount);
            return true;
        } elseif ($decryptedCondition == 'decre') {
            if ($balance->amount < $unmaskedAmount) {
                return false;
            }
            $balance->decrement('amount', $unmaskedAmount);
            return true;
        } else {
            return false;
        }
    }
}
