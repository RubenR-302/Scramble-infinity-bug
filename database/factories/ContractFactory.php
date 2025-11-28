<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => \App\Models\Employee::factory(),
            'contract_type' => fake()->randomElement(['full-time', 'part-time', 'contractor', 'temporary']),
            'salary' => fake()->randomFloat(2, 30000, 150000),
        ];
    }
}
