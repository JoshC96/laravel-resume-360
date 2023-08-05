<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserReferee;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\InvalidCastException;

class RefereeRepository
{

    /**
     * @param User $user 
     * @param array $data 
     * @return UserReferee 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function createUserReferee(User $user, array $data): UserReferee
    {
        $referee = new UserReferee();
        $referee->fill($data);
        $referee->{UserReferee::FIELD_USER_ID} = $user->{User::FIELD_ID};
        $referee->save();

        return $referee;
    }

    /**
     * @param UserReferee $referee 
     * @param array $data 
     * @return bool 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function updateUserReferee(UserReferee $referee, array $data): bool
    {
        $referee->fill($data);
        return $referee->save();
    }
}