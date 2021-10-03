<?php

namespace Database\Factories;

use App\Models\PaymentOption;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentOptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaymentOption::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(15),
            'desc' => $this->faker->text(50),
            'balance' => $this->faker->randomFloat(2, 1000, 100000),
            'is_deletable' => 1,
        ];
    }
}
