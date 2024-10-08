<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employe>
 */
class EmployeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //định nghĩa cho dữ liệu 1 bản ghi
            'first_name'        => fake()->firstName,
            'last_name'         => fake()->lastName,
            'email'             => fake()->unique()->email(),
            'phone'             => fake()->numberBetween(1,23456789),
            'date_of_birth'     => fake()->date(),
            'hire_date'         => fake()->dateTime(),
            'salary'            => fake()->numberBetween(1,2000000),
            'is_active'         => rand(0,1),
            'department_id'     => fake()->randomNumber(),
            'manager_id'        => fake()->randomNumber(),
            'address'           => fake()->address(),
            'profile_picture'   => null,
        ];
    }
}
