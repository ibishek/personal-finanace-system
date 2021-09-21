<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMode as PM;

class PaymentModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modes = array(
            array('title' => 'Cash on Hand', 'is_deletable' => 0),
            array('title' => 'Debit/Credit Card', 'is_deletable' => 0),
            array('title' => 'E-Wallets', 'is_deletable' => 0),
            array('title' => 'Wire Transfer', 'is_deletable' => 0),
        );

        PM::insert($modes);
    }
}
