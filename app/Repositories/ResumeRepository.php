<?php

namespace App\Repositories;

use App\Models\UserResume;

class ResumeRepository
{

    /**
     * @param array $data 
     * @return UserResume
     */
    public function createUserResume(array $data): UserResume
    {
        $resume = new UserResume();
        $resume->fill($data);
        $resume->save();

        return $resume;
    }
}