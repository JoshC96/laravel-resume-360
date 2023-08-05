<?php

namespace App\Repositories;


use App\Models\User;
use App\Models\UserCertification;

class CertificationRepository
{

    /**
     * @param User $user 
     * @param array $data 
     * @return UserCertification
     */
    public function createUserCertification(User $user, array $data): UserCertification
    {
        $certification = new UserCertification();
        $certification->fill($data);
        $certification->{UserCertification::FIELD_USER_ID} = $user->{User::FIELD_ID};
        $certification->save();

        return $certification;
    }

    /**
     * @param UserCertification $certification 
     * @param array $data 
     * @return bool
     */
    public function updateUserCertification(UserCertification $certification, array $data): bool
    {
        $certification->fill($data);
        return $certification->save();
    }
}