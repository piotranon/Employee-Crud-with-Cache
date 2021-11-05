<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model= Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
            'position' => $this->faker->randomElement(['IT Developer','Frontend Developer','Backend Developer','Mid Developer','Laravel Developer','Supervisor']),
            'salary' => $this->faker->randomFloat(2,0,999999)
        ];
    }
}
