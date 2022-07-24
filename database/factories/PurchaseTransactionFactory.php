<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\PurchaseTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model            = PurchaseTransaction::class;

    public function definition()
    {
        return [
            'total_spent'           => $this->faker->randomFloat(2, 0, 100),
            'total_saving'          => $this->faker->randomFloat(2, 0, 100),
            'transaction_at'        => $this->faker->dateTimeBetween('-1 months', 'now'),
        ];
    }
}
