<?php

namespace Database\Factories;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ClinicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clinic::class;

    public function definition(): array
    {
        return [
            'clinic_id' => $this->faker->numberBetween(1, 100),
            'title' => $this->faker->sentence(3),
            'legal_name' => $this->faker->company,
            'address_country' => $this->faker->country,
            'address_region' => $this->faker->state,
            'address_area' => $this->faker->city,
            'address_city' => $this->faker->city,
            'address_street' => $this->faker->streetName,
            'address_house' => $this->faker->buildingNumber,
            'address_flat' => $this->faker->buildingNumber,
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime
        ];
    }
}
