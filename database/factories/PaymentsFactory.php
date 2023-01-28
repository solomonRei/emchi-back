<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Payments;

class PaymentsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payments::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => $this->faker->randomNumber(),
            'notification_id' => $this->faker->randomNumber(),
            'clinic_id' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
            'customerId' => $this->faker->randomNumber(),
            'customerType' => $this->faker->randomElement(['client','company']),
            'date' => $this->faker->date,
            'sum' => $this->faker->randomFloat(2,0,9999),
            'finalSum' => $this->faker->randomFloat(2,0,9999),
            'orderPaidStatus' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
