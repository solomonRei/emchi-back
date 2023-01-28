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
            'service_id' => $this->faker->unique()->numberBetween(1, 100),
            'notification_id' => $this->faker->numberBetween(1, 100),
            'title' => $this->faker->sentence,
            'number' => Str::random(10),
            'order_id' => $this->faker->numberBetween(1, 100),
            'user_id' => $this->faker->numberBetween(1, 100),
            'clinicId' => $this->faker->numberBetween(1, 100),
            'doctor_id' => $this->faker->numberBetween(1, 100),
            'kind' => $this->faker->word,
            'entryTypeId' => $this->faker->numberBetween(1, 100),
            'parentEntryId' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 0, 10000),
            'amount' => $this->faker->numberBetween(1, 10),
            'sum' => $this->faker->numberBetween(1, 10000),
            'finalSum' => $this->faker->numberBetween(1, 10000),
            'date' => $this->faker->date(),
            'status' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'testimony' => $this->faker->paragraph,
            'restriction' => $this->faker->paragraph,
            'result' => $this->faker->paragraph,
            'token_pdf' => Str::random(10),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
