<?php

namespace Database\Factories;

use App\Models\Entity;
use App\Models\JobListing;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobListingFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $industries = ['Government', 'Technology', 'Software', 'Health and Medical', 'Retail', 'Sales', 'Marketing', 'Finance', 'Legal', 'Construction' , 'Mining'];
        $industryIndex = rand(0, count($industries) - 1);
        $salaries = [50000, 60000, 70000, 80000, 90000, 100000, 110000, 120000, 130000];
        $salaryIndex = rand(0, count($salaries) - 1);
        $contracts = ['Full-time', 'Part-time', 'Contract', 'Casual'];
        $contractIndex = rand(0, count($contracts) - 1);

        return [
            JobListing::FIELD_TITLE => fake()->realText(35),
            JobListing::FIELD_INDUSTRY => $industries[$industryIndex],
            JobListing::FIELD_DESCRIPTION => fake()->paragraph(),
            JobListing::FIELD_ROLE => fake()->jobTitle(),
            JobListing::FIELD_SALARY_MIN =>  $salaries[$salaryIndex],
            JobListing::FIELD_SALARY_MAX => $salaries[$salaryIndex],
            JobListing::FIELD_CONTRACT_TYPE => $contractIndex,
        ];
    }
    
}