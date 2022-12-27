<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'login' => $this->faker->word,
            'password' => $this->faker->password,
            'dateBirth' => $this->faker->word,
            'phone' => $this->faker->phoneNumber,
            'idPolis' => $this->faker->randomNumber(),
            'inn' => $this->faker->randomNumber(),
            'snils' => $this->faker->randomNumber(),
            'workplace' => $this->faker->word,
            'remember_token' => $this->faker->word,
        ];
    }
}
