<?php

namespace App\Pipelines\Prompts;

class PromptPayloadFactory
{

    /**
     * @param array $data 
     * @return PromptPayload 
     */
    public static function create(array $data): PromptPayload
    {
        return new PromptPayload(collect($data));
    }
}
