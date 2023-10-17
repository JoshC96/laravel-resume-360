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
        $names = ['Head Office', 'Branch', 'Coworking Space', 'Warehouse'];
        $nameIndex = rand(0, count($names) - 1);

        return [
            EntityLocation::FIELD_NAME => $names[$nameIndex],
            EntityLocation::FIELD_LOCATION_ID => $location->{Location::FIELD_ID}
        ];
    }
}
