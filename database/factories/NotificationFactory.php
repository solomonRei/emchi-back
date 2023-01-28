<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Notification;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name,
            'type' => $this->faker->word,
            'status' => $this->faker->randomElement(['1','0']),
            'deleted_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
