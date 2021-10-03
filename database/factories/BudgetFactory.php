<?php

namespace Database\Factories;

use App\Models\Budget;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Budget::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(25),
            'desc' => $this->faker->text(60),
            'alloted_amount' => $this->faker->randomFloat(2, 1000, 100000),
            'balance_amount' => $this->faker->randomFloat(2, 1000, 99999),
            'expiry_date' => now()->addDays(25),
        ];
    }
}
