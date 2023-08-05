<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserLicence;

class LicenceRepository
{

    /**
     * @param User $user 
     * @param array $data 
     * @return UserLicence
     */
    public function createUserLicence(User $user, array $data): UserLicence
    {
        $licence = new UserLicence();
        $licence->fill($data);
        $licence->{UserLicence::FIELD_USER_ID} = $user->{User::FIELD_ID};
        $licence->save();

        return $licence;
    }

    /**
     * @param UserLicence $licence 
     * @param array $data 
     * @return bool
     */
    public function updateUserLicence(UserLicence $licence, array $data): bool
    {
        $licence->fill($data);
        return $licence->save();
    }
}