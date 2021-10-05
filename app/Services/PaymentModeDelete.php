<?php
//phpcs:ignoreFile
namespace App\Services;

use App\Models\{
    PaymentMode,
    Transaction,
};

// --------------------------- Deprecated ------------------------------//

class PaymentModeDelete
{
    /**
     * Assiatant function before removing the payment mode
     *
     * @param int $id
     * @return boolean
     */
    public function onDelete($id)
    {
        $enabled = $this->__isDeleteEnabled($id);

        if (!$enabled) {
            $reject = [
                'status' => false,
                'error' => 'Payment mode is not deletable'
            ];
            return $reject;
        }

        $noTransactions = $this->__doneAnyTransactions($id);

        if (!$noTransactions) {
            $reject = [
                'status' => false,
                'error' => 'Deleting payment mode is strictly prohibited'
            ];
            return $reject;
        }

        $resolve = [
            'status' => true
        ];
        return $resolve;
    }

    /**
     * Checks whether the mode is avilable to detele or not
     *
     * @param int $id
     * @return boolean
     */
    private function __isDeleteEnabled($id)
    {
        $ifDeletable = PaymentMode::select('is_deletable')->where('id', $id)->get();
        return $ifDeletable[0]->is_deletable == 1 ? true : false;
    }

    /**
     * Checks whether there are any transaction happened or not
     *
     * @param int $id
     * @return boolean
     */
    private function __doneAnyTransactions($id)
    {
        $numbers = Transaction::where('mode_id', $id)->count();
        return $numbers == 0 ? true : false;
    }
}
