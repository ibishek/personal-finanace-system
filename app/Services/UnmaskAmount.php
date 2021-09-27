<?php
//phpcs:ignoreFile
namespace App\Services;

class UnmaskAmount
{
    /**
     * Converts masked amount into float
     * 12,345.67 into 12345.67
     *
     * @param string $amount
     * @return float
     */
    public static function unmask($amount)
    {
        return floatval(preg_replace('/[^\d.]/', '', $amount));
    }
}
