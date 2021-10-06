<?php
//phpcs:ignoreFile
namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Services\UnmaskAmount;
use App\Models\PaymentOption;

class AddBalance
{
    /**
     * Deposit or withdrw balance based on condition or already avilable balance
     *
     * @param float $getBalance
     * @param string $condition
     * @param int $id
     * @return array
     */
    public function saveBalance($getBalance, $condition, $id)
    {
        $unmaskedAmount = UnmaskAmount::unmask($getBalance);

        try {
            $decryptedCondition = Crypt::decrypt($condition);
        } catch (DecryptException $e) {
            return [
                'status' => false,
                'error' => 'It looks like you have messed around with markup'
            ];
        }

        $paymentOption = PaymentOption::findOrFail($id);

        if ($decryptedCondition == 'incre') {
            $paymentOption->increment('balance', $unmaskedAmount);
            return [
                'status' => true,
                'success' => 'Balance deposited successfully'
            ];
        } elseif ($decryptedCondition == 'decre') {
            if ($paymentOption->balance < $unmaskedAmount) {
                return [
                    'status' => false,
                    'error' => 'Requested amount is less than balance amount'
                ];
            }
            $paymentOption->decrement('balance', $unmaskedAmount);
            return [
                'status' => true,
                'success' => 'Balane withdrawn successfully'
            ];
        } else {
            return [
                'status' => false,
                'error' => 'Problems encountered while processing your request'
            ];
        }
    }
}
