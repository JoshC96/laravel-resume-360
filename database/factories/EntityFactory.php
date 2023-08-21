<?php

namespace Database\Factories;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Entity::FIELD_NAME => fake()->company(),
            Entity::FIELD_DESCRIPTION => fake()->paragraph(),
            Entity::FIELD_EMPLOYEE_SIZE => rand(1, 100),
        ];
    }
    
}