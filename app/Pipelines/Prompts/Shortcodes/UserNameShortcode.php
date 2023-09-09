<?php

namespace App\Pipelines\Prompts\Shortcodes;

use App\Abstracts\PromptShortcode;
use App\Pipelines\Prompts\PromptPayload;
use App\Models\User;

class UserNameShortcode extends PromptShortcode 
{

    /**
     * @return string 
     */
    public function getKey(): string
    {
        return 'user-name';
    }

    /**
     * @return string 
     */
    public function getLabel(): string
    {
        return 'User Name';
    }

    /**
     * @param PromptPayload $payload 
     * @return string 
     */
    public function getValue(PromptPayload $payload): string
    {
        $user = $payload->data->get('user');

        return $user ? $user->{User::FIELD_NAME} : '';
    }

}