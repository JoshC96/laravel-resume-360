<?php

namespace Database\Factories;

use App\Models\EntityContact;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityContactFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            EntityContact::FIELD_NAME => fake()->name(),
            EntityContact::FIELD_POSITION => fake()->jobTitle(),
            EntityContact::FIELD_DESCRIPTION => fake()->paragraph(),
            EntityContact::FIELD_PHONE => fake()->phoneNumber(),
            EntityContact::FIELD_EMAIL => fake()->companyEmail(),
        ];
    }
}
