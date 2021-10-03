<?php

namespace App\Services;

use App\Models\{PaymentOption, Transaction};

class PaymentOptionDelete
{
    /**
     * Pointing toward the eloquent model
     *
     * @return object
     */
    private function q()
    {
        return new PaymentOption();
    }

    /**
     * Delete the resource
     *
     * @param int $id
     * @return array
     */
    public function onDelete($id)
    {
        $isEnabled = $this->__isDeleteEnabled($id);
        if (!$isEnabled) {
            return [
                'status' => false,
                'error' => 'Payment option cannnot be deleted'
            ];
        }

        $zeroNoOfTransaction = $this->__foundAnyTransaction($id);
        if (!$zeroNoOfTransaction) {
            return [
                'status' => false,
                'error' => 'Payment option having transaction(s) is/are cannot be deleted'
            ];
        }

        $getPaymentOption = $this->q()->findOrFail($id);
        if ($getPaymentOption->delete()) {
            return [
                'status' => true,
                'success' => 'Payment option deleted successfully'
            ];
        }

        return [
            'status' => false,
            'error' => 'There was a problem encountered while deleting'
        ];
    }

    /**
     * Check whether if user can delete or not
     *
     * @param int $id
     * @return boolean
     */
    private function __isDeleteEnabled($id)
    {

        $isEnabled = $this->q()->where('id', $id)->first();
        return $isEnabled->is_deletable === 1 ? true : false;
    }

    private function __foundAnyTransaction($id)
    {
        $noOfTransactions = Transaction::where('option_id', $id)->count();
        return $noOfTransactions === 0 ? true : false;
    }
}
