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
            'user_id' => $this->faker->numberBetween(1, 10),
            'login' => $this->faker->userName,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'phone' => $this->faker->phoneNumber,
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'secondName' => $this->faker->lastName,
            'birthdate' => $this->faker->date('Y-m-d', 'now'),
            'idPolis' => $this->faker->randomNumber(8),
            'inn' => $this->faker->randomNumber(12),
            'snils' => $this->faker->randomNumber(11),
            'workplace' => $this->faker->company,
            'remember_token' => $this->faker->password(60),
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now', null),
            'updated_at' => $this->faker->dateTimeBetween('-1 years', 'now', null),
            'login_at' => $this->faker->dateTimeBetween('-1 years', 'now', null),
        ];
    }
}
