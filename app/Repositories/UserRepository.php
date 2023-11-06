<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\InvalidCastException;

class UserRepository
{

    /**
     * @param User $user 
     * @param array $data 
     * @return bool 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function updateUser(User $user, array $data): bool
    {
        $user->fill($data);

        if (array_key_exists('roles', $data)) {
            $user->assignRole($data['roles']);
        }

        return $user->save();
    }
}