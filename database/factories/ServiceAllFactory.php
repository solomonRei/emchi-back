<?php

namespace Database\Factories;

use App\Models\ServiceAll;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceAllFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServiceAll::class;

    public function definition(): array
    {
        return [
            'services_all_id' => $this->faker->numberBetween(1, 100),
            'category_id' => $this->faker->numberBetween(1, 100),
            'title' => $this->faker->name,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'clinics_id' => $this->faker->text(100),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
