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
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'doctor' => $this->faker->word,
            'status' => $this->faker->randomElement(["1","0","2"]),
            'date' => $this->faker->time(),
            'requirements' => $this->faker->word,
            'location' => $this->faker->word,
        ];
    }
}
