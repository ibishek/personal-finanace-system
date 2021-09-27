<?php
//phpcs:ignoreFile
namespace App\Services;

use App\Models\{Balance, Budget, Category, PaymentMode, Transaction};
use App\Services\UnmaskAmount;
use DB;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

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
        $budgetId = Budget::getCurrentBudgetId();

        $transaction = [
            'title' => $request['title'],
            'desc' => $request['desc'],
            'budget_id' => $budgetId,
            'mode_id' => $request['mode'],
            'category_id' => $request['category'],
            'amount' => $request['amount']
        ];

        $entry = Category::getEntry($request['category']);
        if ($entry == 'dr') {
            try {
                DB::beginTransaction();
                Transaction::insert($transaction);
                $this->__addToBalance($request['amount'], $transaction['mode_id']);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $reject = [
                    'status' => false,
                    'error' => 'Error on' . $e,
                ];
                return $reject;
            }
        }

        if ($entry == 'cr') {
            // dd($request, $balanceAmount, $remainingBudgetBalance);
            if ($balanceAmount < $request['amount']) {
                $reject = [
                    "status" => false,
                    "error" => "Balance amount is less than requested amount"
                ];
                return $reject;
            }

            $remainingBudgetBalance = $this->__getRemainingBudgetBalance();

            if ($remainingBudgetBalance < $request['amount']) {
                $reject = [
                    "status" => false,
                    "error" => "Budget balance is less than requested amount"
                ];
                return $reject;
            }

            try {
                DB::beginTransaction();

                // $trans['title'] = $request['title'];
                // $trans['desc'] = $request['desc'];
                // $trans['budget_id'] = $budgetId;
                // $trans['mode_id'] = $request['mode'];
                // $trans['category_id'] = $request['category'];
                // $trans['amount'] = $request['amount'];

                // dd($trans);
                Transaction::insert($transaction);
                // dd($trans);

                // $entry = Category::getEntry($request['category']);
                $this->__deductFromBudget($request['amount'], $budgetId);
                $this->__deductFromBalance(
                    $request['amount'],
                    $transaction['mode_id']
                );

                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $reject = [
                    'status' => false,
                    'error' => 'Error found' . $e,
                ];
                return $reject;
            }
        }

        $resolve = [
            'status' => true,
            'success' => 'Transaction successfully created'
        ];
        return $resolve;
    }

    /**
     * Get balance amount
     *
     * @param int $id
     * @return float
     */
    private function __getBalance($id)
    {
        $balance =  Balance::select('amount')->where('mode_id', $id)->first();
        return $balance->amount;
    }

    /**
     * Get remaining budget balance
     *
     * @return float
     */
    private function __getRemainingBudgetBalance()
    {
        $id = Budget::getCurrentBudgetId();
        $budgetBalance =  Budget::select('balance_amount')
            ->where('id', $id)->first();
        return $budgetBalance->balance_amount;
    }

    /**
     * Deduct amount from budget estimate
     *
     * @param int $id
     * @param float $amount
     * @return void
     */
    private function __deductFromBudget($amount, $id)
    {
        Budget::where('id', $id)->decrement('balance_amount', $amount);
    }

    /**
     * Deduct from balance
     *
     * @param float $amount
     * @param int $id
     * @return void
     */
    private function __deductFromBalance($amount, $id)
    {
        Balance::where('mode_id', $id)->decrement('amount', $amount);
    }

    /**
     * Add to balance
     *
     * @param float $amount
     * @param int $id
     * @return void
     */
    private function __addToBalance($amount, $id)
    {
        Balance::where('mode_id', $id)->increment('amount', $amount);
    }
}
