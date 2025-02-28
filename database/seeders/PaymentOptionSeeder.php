<?php

namespace Database\Seeders;

use App\Models\PaymentOption;
use Illuminate\Database\Seeder;

class PaymentOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            ['title' => 'Cash on Hand', 'is_deletable' => 0, 'balance' => 00.00],
            ['title' => 'Debit/Credit Card', 'is_deletable' => 1, 'balance' => 00.00],
            ['title' => 'E-Wallets', 'is_deletable' => 1, 'balance' => 00.00],
            ['title' => 'Wire Transfer', 'is_deletable' => 1, 'balance' => 00.00],
        ];

        array_map(fn ($option) => PaymentOption::create($option), $options);
    }
}
