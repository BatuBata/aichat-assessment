<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model        = Customer::class;

    public function definition()
    {
        return [
            'first_name'            => $this->faker->firstName,
            'last_name'             => $this->faker->lastName,
            'gender'                => $this->faker->randomElement(['Male','Female']),
            'date_of_birth'         => $this->faker->dateTimeBetween('1980-01-01', '2000-12-01'),
            'contact_number'        => $this->faker->phoneNumber,
            'email'                 => $this->faker->email,
        ];
    }
}
