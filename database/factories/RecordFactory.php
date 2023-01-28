<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Record;

class RecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Record::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'record_id' => $this->faker->unique()->numberBetween(1, 100000),
            'notification_id' => $this->faker->numberBetween(1, 100000),
            'user_id' => $this->faker->numberBetween(1, 100000),
            'clinic_id' => $this->faker->numberBetween(1, 100000),
            'order_id' => $this->faker->numberBetween(1, 100000),
            'doctor_id' => $this->faker->numberBetween(1, 100000),
            'status' => $this->faker->randomElement(['confirmed', 'pending', 'cancelled']),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'duration' => $this->faker->numberBetween(30, 120),
            'note' => $this->faker->text(),
            'call_confirmation_status' => $this->faker->randomElement(['confirmed', 'pending', 'cancelled']),
            'appointment_type' => $this->faker->randomElement(['in-person', 'telemedicine']),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
            'deleted_at' => $this->faker->dateTime()
        ];
    }
}
