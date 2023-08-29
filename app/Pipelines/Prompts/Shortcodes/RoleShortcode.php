<?php

namespace App\Pipelines\Prompts\Shortcodes;

use App\Abstracts\PromptShortcode;
use App\Models\JobListing;
use App\Pipelines\Prompts\PromptPayload;
use App\Models\User;

class RoleShortcode extends PromptShortcode
{

    /**
     * @return string 
     */
    public function getKey(): string
    {
        return 'role';
    }

    /**
     * @return string 
     */
    public function getLabel(): string
    {
        return 'role';
    }

    /**
     * @param PromptPayload $payload 
     * @return string 
     */
    public function getValue(PromptPayload $payload): string
    {
        $role = $payload->data->get('role');
        $jobListing = $payload->data->get('job-listing');

        return $role ?? $jobListing->{JobListing::FIELD_ROLE} ?? '';
    }
}