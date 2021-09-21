<?php

namespace App\Services;

class UnmaskAmount
{
    public function unmask($amount)
    {
        return floatval(preg_replace('/[^\d.]/', '', $amount));
    }
}
