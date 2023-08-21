<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Location::FIELD_NAME => fake()->name(),
            Location::FIELD_ADDRESS => fake()->address(),
            Location::FIELD_CITY => fake()->city(),
            Location::FIELD_COUNTRY => fake()->country(),
            Location::FIELD_LATITUDE => fake()->latitude(),
            Location::FIELD_LONGITUDE => fake()->longitude(),
        ];
    }
}
