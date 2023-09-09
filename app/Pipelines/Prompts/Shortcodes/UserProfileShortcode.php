<?php

namespace App\Pipelines\Prompts\Shortcodes;

use App\Abstracts\PromptShortcode;
use App\Pipelines\Prompts\PromptPayload;
use App\Models\User;

class UserProfileShortcode extends PromptShortcode
{

    /**
     * @return string 
     */
    public function getKey(): string
    {
        return 'user-profile';
    }

    /**
     * @return string 
     */
    public function getLabel(): string
    {
        return 'User Profile';
    }

    /**
     * @param PromptPayload $payload 
     * @return string 
     */
    public function getValue(PromptPayload $payload): string
    {
        $user = $payload->data->get('user');

        $certifications = [User::RELATION_CERTIFICATIONS => $user->{User::RELATION_CERTIFICATIONS}->toArray()];
        $licences = [User::RELATION_LICENCES => $user->{User::RELATION_LICENCES}->toArray()];
        $publications = [User::RELATION_PUBLICATIONS => $user->{User::RELATION_PUBLICATIONS}->toArray()];
        $referees = [User::RELATION_REFEREES => $user->{User::RELATION_REFEREES}->toArray()];
        $experiences = [User::RELATION_WORK_EXPERIENCES => $user->{User::RELATION_WORK_EXPERIENCES}->toArray()];
        $qualifications = [User::RELATION_QUALIFICATIONS => $user->{User::RELATION_QUALIFICATIONS}->toArray()];
        $profileData = array_merge(
            $certifications,
            $licences,
            $publications,
            $referees,
            $experiences,
            $qualifications,
        );

        return json_encode(array_filter($profileData, fn ($value) => !empty($value)));
    }
}