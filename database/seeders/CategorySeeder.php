<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['title' => 'Income', 'entry' => 'dr', 'is_deletable' => 0],
            ['title' => 'Expense', 'entry' => 'cr', 'is_deletable' => 0],
            ['title' => 'Profit', 'entry' => 'dr', 'is_deletable' => 1],
            ['title' => 'Loss', 'entry' => 'cr', 'is_deletable' => 1],
        ];

        array_map(fn ($category) => Category::create($category), $categories);
    }
}
