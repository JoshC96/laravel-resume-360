<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserPublication;

class PublicationRepository
{

    /**
     * @param User $user 
     * @param array $data 
     * @return UserPublication
     */
    public function createUserPublication(User $user, array $data): UserPublication
    {
        $publication = new UserPublication();
        $publication->fill($data);
        $publication->{UserPublication::FIELD_USER_ID} = $user->{User::FIELD_ID};
        $publication->save();

        return $publication;
    }

    /**
     * @param UserPublication $publication 
     * @param array $data 
     * @return bool
     */
    public function updateUserPublication(UserPublication $publication, array $data): bool
    {
        $publication->fill($data);
        return $publication->save();
    }
}