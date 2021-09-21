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
        $categories = array(
            array('title' => 'Income', 'entry' => 'dr'),
            array('title' => 'Expense', 'entry' => 'cr'),
            array('title' => 'Profit', 'entry' => 'dr'),
            array('title' => 'Loss', 'entry' => 'cr')
        );

        Category::insert($categories);
    }
}
