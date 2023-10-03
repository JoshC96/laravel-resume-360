<?php

namespace App\Repositories;

use App\Models\EntityContact;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\InvalidCastException;

class JobListingRepository
{

    /**
     * @param array $data 
     * @return JobListing 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function createJobListing(array $data): JobListing
    {
        $job = new JobListing();
        $job->fill($data);
        $job->save();

        return $job;
    }

    /**
     * @param JobListing $referee 
     * @param array $data 
     * @return bool 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function updateJobListing(JobListing $job, array $data): bool
    {
        $job->fill($data);
        return $job->save();
    }
}