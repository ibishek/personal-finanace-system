<?php
//phpcs:ignoreFile
namespace App\Services;

use App\Models\{Budget, Category, PaymentOption, Transaction};
use App\Services\UnmaskAmount;
use DB;

class TransactionService
{
    /**
     * It saves transaction and its associated requests
     *
     * @param array $request
     * @return array
     */
    public function onSave($request)
    {
        $request['amount'] = UnmaskAmount::unmask($request['amount']);

        $balanceAmount = $this->__getBalance($request['mode']);
        $budgetId = Budget::where('is_active', 1)->first('id');
        $budgetId = $budgetId->id;

        $transaction = [
            'title' => $request['title'],
            'desc' => $request['desc'],
            'budget_id' => $budgetId,
            'option_id' => $request['mode'],
            'category_id' => $request['category'],
            'amount' => $request['amount']
        ];

        $entry = Category::getEntry($request['category']);
        if ($entry == 'dr') {
            try {
                DB::beginTransaction();
                Transaction::create($transaction);
                $this->__addToPaymentOption($transaction['option_id'], $request['amount']);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return [
                    'status' => false,
                    'error' => 'Error on' . $e,
                ];
            }
        }

        if ($entry == 'cr') {
            if ($balanceAmount < $request['amount']) {
                return [
                    "status" => false,
                    "error" => "Balance amount is less than requested amount"
                ];
            }

            $remainingBudgetBalance = $this->__getRemainingBudgetBalance($budgetId);

            if ($remainingBudgetBalance < $request['amount']) {
                return [
                    "status" => false,
                    "error" => "Budget balance is less than requested amount"
                ];
            }

            try {
                DB::beginTransaction();

                Transaction::create($transaction);
                $this->__deductFromBudget($budgetId, $request['amount']);
                $this->__deductFromPaymentOption($transaction['option_id'], $request['amount']);

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                return [
                    'status' => false,
                    'error' => "Error found $e",
                ];
            }
        }

        return [
            'status' => true,
            'success' => 'Transaction created successfully'
        ];
    }

    /**
     * Get balance amount
     *
     * @param int $id
     * @return float
     */
    private function __getBalance($id)
    {
        $getBalance =  PaymentOption::where('id', $id)->first('balance');
        return $getBalance->balance;
    }

    /**
     * Get remaining budget balance
     *
     * @return float
     */
    private function __getRemainingBudgetBalance($id)
    {
        $budgetBalance =  Budget::where('id', $id)
            ->latest()
            ->first('balance_amount');
        return $budgetBalance->balance_amount;
    }

    /**
     * Add balance to payment option
     *
     * @param int $id
     * @param float $amount
     * @return void
     */
    private function __addToPaymentOption($id, $amount)
    {
        PaymentOption::where('id', $id)->increment('balance', $amount);
    }

    /**
     * Deduct amount from budget estimate
     *
     * @param int $id
     * @param float $amount
     * @return void
     */
    private function __deductFromBudget($id, $amount)
    {
        Budget::where('id', $id)->decrement('balance_amount', $amount);
    }

    /**
     * Deduct balance from payment option
     *
     * @param int $id
     * @param float $amount
     * @return void
     */
    private function __deductFromPaymentOption($id, $amount)
    {
        PaymentOption::where('id', $id)->decrement('balance', $amount);
    }
}
