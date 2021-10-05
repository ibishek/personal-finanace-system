<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = new Category();
        $categories = array(
            array('title' => 'Income', 'entry' => 'dr', 'is_deletable' => 0),
            array('title' => 'Expense', 'entry' => 'cr', 'is_deletable' => 0),
            array('title' => 'Profit', 'entry' => 'dr', 'is_deletable' => 1),
            array('title' => 'Loss', 'entry' => 'cr', 'is_deletable' => 1)
        );

        $categories->save();
    }
}
