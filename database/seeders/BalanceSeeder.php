<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Balance;

class BalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $balances = array(
            array('mode_id' => 1, 'amount' => 00.00),
            array('mode_id' => 2, 'amount' => 00.00),
            array('mode_id' => 3, 'amount' => 00.00),
            array('mode_id' => 4, 'amount' => 00.00)
        );

        Balance::insert($balances);
    }
}
