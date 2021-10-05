<?php

namespace App\Services;

use App\Models\{Budget, Category, Transaction};

class CalculatePercentageForExpenseTransaction
{
    /**
     * Prepare necessary arrangement for calculating percentage // when having entry type 'cr'
     *
     * @param int $transactionCategoryId
     * @param float $transactionAmount
     * @param int $transactionBudgetId
     * @return float/null
     */
    public function percentage($transactionCategoryId, $transactionAmount, $transactionBudgetId)
    {
        $entry = $this->__provideEntry($transactionCategoryId);
        if (
            $entry !== 'cr'
        ) {
            return null;
        }

        $totalBudgetAmount = $this->__budgetAmount($transactionBudgetId);

        $percent =  $this->__calculatePercentage(
            $transactionAmount,
            $totalBudgetAmount
        );
        return $percent; // direct retrun from private method could throw an error
    }

    /**
     * Actually calculate percentage
     *
     * @param float $amount
     * @param float $total
     * @return float
     */
    private function __calculatePercentage($amount, $total)
    {
        return number_format(($amount * 100) / $total, 2);
    }

    /**
     * Return entry type based on resource
     *  i.e. either 'dr' or 'cr'
     *
     * @param int $id
     * @return string
     */
    private function __provideEntry($id)
    {
        $categoryCollection = Category::where('id', $id)->first('entry');
        return $categoryCollection->entry;
    }

    /**
     * Retrun budget amount based on resource
     *
     * @param int $id
     * @return float
     */
    private function __budgetAmount($id)
    {
        $budgetCollection = Budget::where('id', $id)->get('alloted_amount');
        return $budgetCollection[0]->alloted_amount;
    }
}
