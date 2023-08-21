<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\EntityContact;
use App\Models\EntityLocation;
use App\Models\JobListing;
use App\Models\Location;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Location::factory(5)->create();

        Entity::factory(50)
            ->has(EntityLocation::factory()->count(5), Entity::RELATION_LOCATIONS)
            ->has(EntityContact::factory()->count(5), Entity::RELATION_CONTACTS)
            ->has(JobListing::factory()->count(10), Entity::RELATION_JOBS)
            ->create();
    }
}
