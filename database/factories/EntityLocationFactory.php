<?php

namespace Database\Factories;

use App\Models\Entity;
use App\Models\EntityLocation;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityLocationFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $location = Location::inRandomOrder()->first();

        return [
            EntityLocation::FIELD_NAME => fake()->name(),
            EntityLocation::FIELD_DESCRIPTION => fake()->paragraph(),
            EntityLocation::FIELD_LOCATION_ID => $location->{Location::FIELD_ID}
        ];
    }
}
