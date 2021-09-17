<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array(
            array('title' => 'Income'),
            array('title' => 'Expenditure'),
            array('title' => 'Profit'),
            array('title' => 'Loss')
        );

        Type::insert($types);
    }
}
