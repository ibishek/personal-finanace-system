<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentOption;

class PaymentOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = array(
            array('title' => 'Cash on Hand', 'is_deletable' => 0, 'balance' => 00.00),
            array('title' => 'Debit/Credit Card', 'is_deletable' => 1, 'balance' => 00.00),
            array('title' => 'E-Wallets', 'is_deletable' => 1, 'balance' => 00.00),
            array('title' => 'Wire Transfer', 'is_deletable' => 1, 'balance' => 00.00),
        );

        array_map(fn ($option) => PaymentOption::create($option), $options);
    }
}
