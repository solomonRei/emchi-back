<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Doctor;

class DoctorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Doctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'doctor_id' => $this->faker->randomNumber(),
            'currentClinicId' => $this->faker->randomNumber(),
            'surname' => $this->faker->lastName,
            'name' => $this->faker->firstName,
            'secondName' => $this->faker->firstName,
            'phone' => $this->faker->phoneNumber,
            'location' => $this->faker->city,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
