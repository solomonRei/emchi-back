<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Analysis;

class AnalysisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Analysis::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'date' => $this->faker->word,
            'doctor' => $this->faker->word,
            'location' => $this->faker->word,
            'payment' => $this->faker->word,
            'result' => $this->faker->text,
        ];
    }
}
