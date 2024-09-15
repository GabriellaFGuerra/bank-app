<?php

namespace Database\Factories;

use App\Models\Balance;
use Illuminate\Database\Eloquent\Factories\Factory;

class BalanceFactory extends Factory
{
    // The corresponding model for this factory
    protected $model = Balance::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'value' => $this->faker->randomFloat(2, 0, 1000), // Example balance value
            'created_at' => now(),
            'updated_at' => now(),
            'date' => now()
        ];
    }
}
