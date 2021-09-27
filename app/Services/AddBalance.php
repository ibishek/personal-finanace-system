<?php
//phpcs:ignoreFile
namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Services\UnmaskAmount;
use App\Models\Balance;

class AddBalance
{
    public function saveBalance($amount, $condition, $id)
    {
        $unmaskedAmount = UnmaskAmount::unmask($amount);

        try {
            $decryptedCondition = Crypt::decrypt($condition);
        } catch (DecryptException $e) {
            $reject = [
                'status' => false,
                'error' => 'It looks like you have messed around with markup'
            ];
            return $reject;
        }

        $balance = Balance::findOrFail($id);

        if ($decryptedCondition == 'incre') {
            $balance->increment('amount', $unmaskedAmount);
            $resolve = [
                'status' => true
            ];
            return $resolve;
        } elseif ($decryptedCondition == 'decre') {
            if ($balance->amount < $unmaskedAmount) {
                $reject = [
                    'status' => false,
                    'error' => 'Requested amount is less than balance amount'
                ];
                return $reject;
            }
            $balance->decrement('amount', $unmaskedAmount);
            $resolve = [
                'status' => true
            ];
            return $resolve;
        } else {
            $reject = [
                'status' => false,
                'error' => 'Problems encountered while processing your request'
            ];
            return $reject;
        }
    }
}
