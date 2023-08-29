<?php

namespace App\Repositories;

use App\Models\UserJobApplication;

class JobApplicationRepository
{

    /**
     * @param array $data 
     * @return UserJobApplication
     */
    public function createUserJobApplication(array $data): UserJobApplication
    {
        $application = new UserJobApplication();
        $application->fill($data);
        $application->save();

        return $application;
    }
}