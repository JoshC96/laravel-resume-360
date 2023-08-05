<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserWorkExperience;

class WorkExperienceRepository
{

    /**
     * @param User $user 
     * @param array $data 
     * @return UserWorkExperience
     */
    public function createUserWorkExperience(User $user, array $data): UserWorkExperience
    {
        $workExperience = new UserWorkExperience();
        $workExperience->fill($data);
        $workExperience->{UserWorkExperience::FIELD_USER_ID} = $user->{User::FIELD_ID};
        $workExperience->save();

        return $workExperience;
    }

    /**
     * @param UserWorkExperience $workExperience 
     * @param array $data 
     * @return bool
     */
    public function updateUserWorkExperience(UserWorkExperience $workExperience, array $data): bool
    {
        $workExperience->fill($data);
        return $workExperience->save();
    }
}