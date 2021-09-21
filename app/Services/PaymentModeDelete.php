<?php

namespace App\Services;

use App\Models\{
    PaymentMode,
    Transaction,
};

class PaymentModeDelete
{
    public function onDelete($id)
    {
        $enabled = $this->isDeleteEnabled($id);

        if (!$enabled) {
            return false;
        }

        $noTransactions = $this->doneAnyTransactions($id);

        if (!$noTransactions) {
            return false;
        }

        return true;
    }

    private function isDeleteEnabled($id)
    {
        $ifDeletable = PaymentMode::select('is_deletable')->where('id', $id)->get();

        return $ifDeletable[0]->is_deletable == 1 ? true : false;
    }

    private function doneAnyTransactions($id)
    {
        $numbers = Transaction::where('mode_id', $id)->count();
        return $numbers == 0 ? true : false;
    }
}
