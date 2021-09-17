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
            array('title' => 'Cash'),
            array('title' => 'Debit/Credit Card'),
            array('title' => 'E-Wallets'),
            array('title' => 'Wire Transfer'),
        );

        PM::insert($modes);
    }
}
