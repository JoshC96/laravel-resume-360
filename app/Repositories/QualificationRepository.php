<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserQualification;
use App\Models\UserReferee;

class QualificationRepository
{

    /**
     * @param User $user 
     * @param array $data 
     * @return UserReferee
     */
    public function createUserQualification(User $user, array $data): UserQualification
    {
        $qualfiication = new UserQualification();
        $qualfiication->fill($data);
        $qualfiication->{UserQualification::FIELD_USER_ID} = $user->{User::FIELD_ID};
        $qualfiication->save();

        return $qualfiication;
    }

    /**
     * @param UserQualification $qualification 
     * @param array $data 
     * @return bool
     */
    public function updateUserQualification(UserQualification $qualification, array $data): bool
    {
        $qualification->fill($data);
        return $qualification->save();
    }
}