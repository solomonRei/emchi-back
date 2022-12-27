<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Service;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'date' => $this->faker->time(),
            'description' => $this->faker->text,
            'testimony' => $this->faker->text,
            'restriction' => $this->faker->text,
            'result' => $this->faker->text,
        ];
    }
}
